<?php
namespace App\Events;

use App\Events\Event;

class UserManageAction extends Event
{
   
    /**
     * Create a new event instance.
     *
     * @param $emailData
     * @return void
     */
    public $emailData;
    public function __construct($emailData)
    {
        $this->userId = $emailData['userId'];
        $this->email = $emailData['email'];
        $this->name = $emailData['name'];
        $this->password = $emailData['password'];
        $this->website = $emailData['website'];
        $this->overlays = $emailData['overlays'];
        $this->infusion = $emailData['infusion'];
        $this->dynamic_ads = $emailData['dynamic_ads'];
        $this->programmatic = $emailData['programmatic'];
    
    }
}