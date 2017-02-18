<?php
/**
 * MPlaying Reallife - Control Panel
 * https://cp.MPlaying.eu
 *
 * Author: Francesco Paolocci
 * Created: 18.02.2017 - 19:04
 * IDE: PhpStorm
 */

namespace MPlaying\OAuth2\MPlaying\Provider;


use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class MPlayingResourceOwner implements ResourceOwnerInterface
{

    /**
     * @var array
     */
    private $response = [];

    public function __construct($data)
    {
        $this->response = $data;
    }

    /**
     * Returns the identifier of the authorized resource owner.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->response['userid'] ?: null;
    }

    /**
     * Returns the username of the authorized resource owner.
     *
     * @return mixed
     */
    public function getUsername()
    {
        return $this->response['username'] ?: null;
    }

    /**
     * Returns the profilelink of the authorized resource owner.
     *
     * @return mixed
     */
    public function getProfileLink()
    {
        return $this->response['links']['profile'] ?: null;
    }

    /**
     * Returns the avatarlink of the authorized resource owner.
     *
     * @return mixed
     */
    public function getAvatarLink()
    {
        return $this->response['links']['avatar'] ?: null;
    }

    /**
     * Returns the avatarlink of the authorized resource owner. (user_email scope reqiured)
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->response['email'] ?: null;
    }

    /**
     * Returns the amount of money on the hand of the authorized resource owner. (user_bank scope reqiured)
     *
     * @return mixed
     */
    public function getHandMoney()
    {
        return $this->response['money']['hand'] ?: null;
    }

    /**
     * Returns the sum of money on the bank of the authorized resource owner. (user_bank scope reqiured)
     *
     * @return mixed
     */
    public function getBankMoney()
    {
        return $this->response['money']['bank'] ?: null;
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}