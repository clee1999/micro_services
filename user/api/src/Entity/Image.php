<?php
// api/src/Entity/Image.php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CreateImageAction;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
#[ApiResource(
    collectionOperations: [
        'get',
        'post' => [
            'controller' => CreateImageAction::class,
            'deserialize' => false,
            'validation_groups' => ['Default', 'user_images_create'],
            'openapi_context' => [
                'requestBody' => [
                    'content' => [
                        'multipart/form-data' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'file' => [
                                        'type' => 'string',
                                        'format' => 'binary',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    iri: 'http://schema.org/Image',
    itemOperations: ['get'],
    normalizationContext: ['groups' => ['user_image:read']]
)]
class Image
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */
    private ?int $id = null;

    #[ApiProperty(iri: 'http://schema.org/contentUrl')]
    #[Groups(['user_image:read'])]
    public ?string $contentUrl = null;

    /**
     * @Vich\UploadableField(mapping="user_image", fileNameProperty="filePath")
     */
    #[Assert\NotNull(groups: ['user_image_create'])]
    public ?File $file = null;

    /**
     * @ORM\Column(nullable=true)
     */
    public ?string $filePath = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
