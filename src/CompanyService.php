<?php
namespace Clickatell;

use \InvalidArgumentException;
use \Exception;
use \PDO;

class CompanyService
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
    
    /**
     * Select a company
     */
    function getCompany($companyId) {
       $stmt = $this->database->query('SELECT * FROM companies WHERE `company_id`=' . $companyId);        
       $company = $stmt->fetch(PDO::FETCH_ASSOC);
       
       if (empty($company)) {
          throw new InvalidArgumentException('Company could not be found.');
       }
    }
    
    /**
     * Select a company
     */
    function getUser($userId) {
        $stmt = $this->database->query('SELECT * FROM users WHERE user_id=' . $userId);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($user)) {
            throw new InvalidArgumentException('User could not be found.');
        }
    }
    
    /**
     * Select all the users in a company
     */
    function getUsers($companyId) {
        $stmt = $this->database->query('SELECT * FROM users WHERE company_id=' . $companyId);

        while($user = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
            yield $user;
        }
    }
    

    /**
     * Locate all the users in a company
     */
    public function locateCompanyUsers($companyId)
    {
        $this->getCompany($companyId);             
       
        foreach($this->getUsers($companyId) as $user) {
            return $user;
        }
    }

    /**
     * Delete all the users belonging to a specific company
     */
    public function deleteCompanyUsers($companyId)
    {
        $this->getCompany($companyId);

        return $this->database->exec('DELETE FROM users WHERE company_id=' . $companyId);
    }

    /**
     * Link a specific user ID to a company ID
     */
    public function linkCompanyUser($userId, $companyId)
    {
        $this->getCompany($companyId);

        $this->getUser($userId);

        return $this->database->exec('UPDATE users SET company_id=' . $companyId . ' WHERE user_id=' . $userId);
    }

    /**
     * Broadcast the worth of a user and return the result as
     * an array
     */
    public function userWorth($companyId)
    {
        foreach($this->getUsers($companyId) as $user) {
            $users = $user;
        }

        foreach ($users as $user)
        {
            switch ($user['user_mtype'])
            {
                case 3:
                    $result[] = $user['user_name'] . ': Worth means nothing to me.';
                    break;
                case 2:
                    $result[] = $user['user_name'] . ': I am worth billions.';
                    break;
                default:
                    $result[] = $user['user_name'] . ': I am not worth much.';
                    break;
            }
        }

        return $result;
    }
}