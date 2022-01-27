<style scoped lang="scss"></style>
<template>
  <div>
    <v-container style="height: 100%">
      <v-stepper v-model="e1">
        <v-stepper-header>
          <v-stepper-step :complete="e1 > 1" step="1">
            Choix du créneaux
          </v-stepper-step>

          <v-divider></v-divider>

          <v-stepper-step :complete="e1 > 2" step="2">
            Connexion / Inscription
          </v-stepper-step>

          <v-divider></v-divider>
          <v-stepper-step :complete="e1 > 3" step="3">
            Récapitulatif
          </v-stepper-step>

          <v-divider></v-divider>

          <v-stepper-step step="4"> Validation </v-stepper-step>
        </v-stepper-header>

        <v-stepper-items>
          <v-stepper-content step="1">
            <v-container>
              <v-row align="center">
                <v-date-picker
                  v-model="date"
                  full-width
                  class="mt-4"
                  @change="handleDate"
                ></v-date-picker>
              </v-row>
              <v-item-group mandatory>
                <v-row id="slots_container">
                  <v-col
                    :key="index"
                    v-for="(slot, index) in slots"
                    cols="12"
                    sm="2"
                  >
                    <v-item
                      @change="handleSlot(slot)"
                      v-if="
                        slot.available == true &&
                        slot.doctor == iriDoctor &&
                        checkSlot(slot.slotStart, slot.slotEnd) == true
                      "
                      v-slot="{ active, toggle }"
                    >
                      <v-card class="d-flex align-center" @click="toggle">
                        <v-scroll-y-transition>
                          <div
                            v-if="active"
                            class="flex-grow-1 text-center cyan lighten-4"
                          >
                            {{ getSlotView(slot) }}
                          </div>
                          <div v-else class="flex-grow-1 text-center">
                            {{ getSlotView(slot) }}
                          </div>
                        </v-scroll-y-transition>
                      </v-card>
                    </v-item>
                    <v-item v-else></v-item>
                  </v-col>
                </v-row>
              </v-item-group>
            </v-container>
            <v-btn color="primary" @click="e1 = 2"> Continue </v-btn>

            <v-btn text> Cancel </v-btn>
          </v-stepper-content>

          <v-stepper-content step="2">
            <v-container>
              <v-row>
                <v-col cols="12">
                  <h3 v-if="user">
                    Vous êtes connecté en tant que
                    {{ user.firstname }}
                    {{ user.lastname }}
                  </h3>
                </v-col>
              </v-row>
              <v-row v-if="!user">
                <v-col cols="12">
                  <h3>Pas encore de compte ?</h3>
                  <button class="buttonCustom">
                    <div class="height-fix">Créer un compte</div>
                  </button>
                </v-col>
              </v-row>
              <v-row v-if="!user">
                <v-col cols="12">
                  <!-- TODO : pour chacun des boutons, href vers les pages de connexion / inscription -->
                  <!-- TODO : Display ces boutons si l'user est un invité, si déjà connecté les masqués -->
                  <h3>Déjà un compte ?</h3>
                  <button class="buttonCustom">
                    <div class="height-fix">Se connecter</div>
                  </button>
                </v-col>
              </v-row>
            </v-container>
            <v-btn color="primary" @click="e1 = 3"> Continue </v-btn>

            <v-btn text> Cancel </v-btn>
          </v-stepper-content>

          <v-stepper-content step="3">
            <form @submit.prevent="handleSubmit">
              <v-container>
                <v-row class="text-center">
                  <v-col cols="12">
                    <h2>Récapitulatif du rendez-vous</h2>
                  </v-col>
                </v-row>
                <v-row class="text-center">
                  <v-col cols="12">
                    <h4 v-if="user">
                      {{ user.firstname }} {{ user.lastname }}, vous avez pris
                      un rendez-vous pour le :
                    </h4>
                    <p v-if="selectedDate != null">Date : {{ selectedDate }}</p>
                    <p v-if="selectedSlot != null">
                      à l'heure {{ displayHourMinute(selectedSlot.slotStart) }}
                    </p>
                    <p v-if="selectedSlot != null">
                      Chez le practicien : {{ doctorName }}
                    </p>
                    <v-textarea
                      outlined
                      v-model="description"
                      name="description"
                      label="Description"
                      value=""
                    ></v-textarea>
                  </v-col>
                </v-row>
              </v-container>
              <!-- <button class="buttonCustom ml-4 mb-3 mr-6">S'inscrire</button> -->
              <v-btn color="primary" type="submit" @click="e1 = 4">
                Continue
              </v-btn>
              <v-btn text> Cancel </v-btn>
            </form>
          </v-stepper-content>

          <v-stepper-content step="4">
            <v-container>
              <v-row class="text-center">
                <v-col cols="12">
                  <v-icon color="green" x-large>mdi-calendar-check</v-icon>
                  <h2>Votre réservation a été confirmé !</h2>
                  <router-link to="/mes-rendez-vous"
                    >Voir mes rendez-vous</router-link
                  >
                </v-col>
              </v-row>
            </v-container>
            <v-btn color="primary" @click="e1 = 1"> Continue </v-btn>

            <v-btn text> Cancel </v-btn>
          </v-stepper-content>
        </v-stepper-items>
      </v-stepper>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "StepperReservation",
  data() {
    return {
      e1: 1,
      user: null,
      iriDoctor: null,
      selectedDate: null,
      selectedSlot: null,
      description: "",
      patient: "",
      doctor: null,
      doctorName: null,
      date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      slots: [],
    };
  },
  methods: {
    async getDoctorJson() {
      let id = this.$route.params.id;
      await axios
        .get(`users/${id}`)
        .then((result) => {
          console.log(result);
          this.doctorName =
            "Dr. " + result.data.firstname + " " + result.data.lastname;

          // this.slots = result.data["hydra:member"];
        })
        .catch((err) => {
          console.log(err);
        });
    },
    displayHourMinute(d) {
      let date = new Date(d);
      return (
        String(date.getHours()).padStart(2, "0") +
        ":" +
        String(date.getMinutes()).padStart(2, "0")
      );
    },
    handleSlot(slot) {
      this.selectedSlot = slot;
    },
    getSlotView(slot) {
      let start = new Date(slot.slotStart);
      let end = new Date(slot.slotEnd);
      return (
        String(start.getHours()).padStart(2, "0") +
        ":" +
        String(start.getMinutes()).padStart(2, "0") +
        " - " +
        String(end.getHours()).padStart(2, "0") +
        ":" +
        String(end.getMinutes()).padStart(2, "0")
      );
    },
    checkSlot(slots, slote) {
      if (
        this.selectedDate == slots.split("T")[0] &&
        this.selectedDate == slote.split("T")[0]
      ) {
        return true;
      } else {
        return false;
      }
    },
    async handleSubmit() {
      const id = this.$route.params.id;
      const idSlot = this.selectedSlot.id;
      this.selectedSlot.available = false;
      try {
        const response = await axios.post("reservations", {
          description: this.description,
          patient: `api/users/${this.user.id}`,
          doctor: `api/users/${id}`,
          slot: `api/time_slots/${idSlot}`,
        });
        console.log("ok");
        if (response.data.success) {
          console.log("ok");
        } else {
          this.errors = response.data.message;
        }
      } catch (error) {
        this.errors = error.response.data.message;
      }
    },
    async handleDate(val) {
      this.selectedDate = val;
      //   const id = this.$route.params.id;
      this.slots = [];
      await axios
        .get("time_slots", {})
        .then((result) => {
          result.data["hydra:member"].forEach((slot) => {
            if (
              this.checkSlot(slot.slotStart, slot.slotEnd) == true &&
              slot.available == true &&
              slot.doctor == this.iriDoctor
            ) {
              this.slots.push(slot);
            }
          });

          // this.slots = result.data["hydra:member"];
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getData() {
      const id = this.$route.params.id;

      axios.get(`users/${id}`).then((response) => {
        this.doctor = response.data;
      });
      this.getDoctorJson();
    },
  },
  mounted() {
    this.iriDoctor = "/api/users/" + this.$route.params.id;
    this.getData();
  },
  //   watch: {
  //     // whenever question changes, this function will run
  //     slots: function (newSlot, oldSlot) {
  //       for (let slot in newSlot) {
  //         this.renderSlot(slot);
  //       }
  //       console.log(newSlot);
  //       //   this.answer = 'Waiting for you to stop typing...'
  //       //   this.debouncedGetAnswer()
  //     },
  //   },
  async created() {
    const response = await axios.get("me");
    this.user = response.data;
    console.log("The id is: " + this.$route.params.id);
  },
};
</script>
