<?php


namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=2,
     *     max=100
     * )
     */
    private string $firstname;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=2,
     *     max=100
     * )
     */
    private string $lastname;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private string $email;

    /**
     * @var ?string
     * @Assert\Regex(
     *     pattern="/[0-9]{10}/"
     * )
     */
    private ?string $phone = null;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
    private string $subject;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private string $message;

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return Contact
     */
    public function setFirstname(string $firstname): Contact
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return Contact
     */
    public function setLastname(string $lastname): Contact
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Contact
     */
    public function setEmail(string $email): Contact
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return Contact
     */
    public function setPhone(?string $phone): Contact
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return Contact
     */
    public function setSubject(string $subject): Contact
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Contact
     */
    public function setMessage(string $message): Contact
    {
        $this->message = $message;
        return $this;
    }
}
