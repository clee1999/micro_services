<style scoped lang="scss">
h4 {
  margin-top: 20px !important;
}

h2 {
  color: #fa7f57;
}
</style>
<template>
  <div>
    <v-container fluid style="height: 100vh">
      <v-data-table
        :headers="headers"
        :items="reservations"
        sort-by="calories"
        class="elevation-1"
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>My CRUD</v-toolbar-title>
            <v-divider class="mx-4" inset vertical></v-divider>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="500px">
              <template v-slot:activator="{ on, attrs }">
                <v-btn
                  color="primary"
                  dark
                  class="mb-2"
                  v-bind="attrs"
                  v-on="on"
                >
                  New Item
                </v-btn>
              </template>
              <v-card>
                <v-card-title>
                  <span class="text-h5">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <v-row>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.patient"
                          label="Patient"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.date"
                          label="Date"
                        ></v-text-field>
                      </v-col>
                      <v-col cols="12" sm="6" md="4">
                        <v-text-field
                          v-model="editedItem.description"
                          label="Description"
                        ></v-text-field>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="close">
                    Cancel
                  </v-btn>
                  <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
            <v-dialog v-model="dialogDelete" max-width="500px">
              <v-card>
                <v-card-title class="text-h5"
                  >Are you sure you want to delete this item?</v-card-title
                >
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="closeDelete"
                    >Cancel</v-btn
                  >
                  <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                    >OK</v-btn
                  >
                  <v-spacer></v-spacer>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-toolbar>
        </template>
        <template v-slot:item.actions="{ item }">
          <v-icon small class="mr-2" @click="editItem(item)">
            mdi-pencil
          </v-icon>
          <v-icon small class="mr-2" @click="deleteItem(item)">
            mdi-delete
          </v-icon>
        </template>
        <template v-slot:no-data>
          <v-btn color="primary" @click="initialize"> Reset </v-btn>
        </template>
      </v-data-table>
    </v-container>
  </div>
</template>

<script>
export default {
  name: "DoctorDashboardReservation",
  data: () => ({
    justify: ["center"],
    dialog: false,
    dialogDelete: false,
    editedIndex: -1,
    editedItem: {
      name: "",
      date: 0,
      description: 0,
    },
    defaultItem: {
      name: "",
      date: 0,
      description: 0,
    },
    reservations: [],

    headers: [
      {
        text: "Patient",
        align: "start",
        sortable: true,
        value: "patient",
      },
      {
        text: "Date",
        align: "start",
        sortable: true,
        value: "date",
      },
      {
        text: "Description",
        align: "start",
        sortable: true,
        value: "description",
      },
      {
        text: "Actions",
        align: "start",
        value: "actions",
      },
    ],
  }),

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.initialize();
  },
  methods: {
    initialize() {
      this.reservations = [
        {
          patient: "test",
          date: "19-02-1999",
          description: "wesh",
        },
        {
          patient: "test",
          date: "19-02-1999",
          description: "wesh",
        },
        {
          patient: "test",
          date: "19-02-1999",
          description: "wesh",
        },
        {
          patient: "test",
          date: "19-02-1999",
          description: "wesh",
        },
        {
          patient: "test",
          date: "19-02-1999",
          description: "wesh",
        },
        {
          patient: "test",
          date: "19-02-1999",
          description: "wesh",
        },
        {
          patient: "test",
          date: "19-02-1999",
          description: "wesh",
        },
        {
          patient: "test",
          date: "19-02-1999",
          description: "wesh",
        },
        {
          patient: "test",
          date: "19-02-1999",
          description: "wesh",
        },
        {
          patient: "test",
          date: "19-02-1999",
          description: "wesh",
        },
        {
          patient: "test",
          date: "19-02-1999",
          description: "wesh",
        },
      ];
    },

    editItem(item) {
      this.editedIndex = this.reservations.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.reservations.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.reservations.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.reservations[this.editedIndex], this.editedItem);
      } else {
        this.reservations.push(this.editedItem);
      }
      this.close();
    },
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },
};
</script>
