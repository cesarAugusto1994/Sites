<?php
/**
 * Created by PhpStorm.
 * User: cesar
 * Date: 20/07/16
 * Time: 11:56
 */

namespace Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Doctrine\DBAL\Connection;

class UserProvider implements UserProviderInterface
{
    private $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }

    /**
     * @param string $username
     * @return \Security\User
     * @throws \Doctrine\DBAL\DBALException
     */
    public function loadUserByUsername($username)
    {
        $stmt = $this->conn->executeQuery('SELECT * FROM silex.user WHERE email = ?', array(strtolower($username)));

        if (!$user = $stmt->fetch()) {
            throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
        }

        return new \Security\User($user, explode(',', $user['roles']), true, true, true, true);
    }

    /**
     * @param UserInterface $user
     * @return \Security\User
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof \Security\User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Symfony\Component\Security\Core\User\User';
    }
}