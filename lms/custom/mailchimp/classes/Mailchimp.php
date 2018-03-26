<?php

require_once ('/htdocs/home/learningindrops.com/www/lms/class.pdo.database.php');
require_once ('/htdocs/home/learningindrops.com/www/lms/custom/mailchimp/classes/vendor/autoload.php');

use DrewM\MailChimp\MailChimp;

class Maim
{
    const KEY = '173d1cc42781fa013c24e638756428cb-us12'; // Shevchenko key
    //const KEY = '';
    public $db, $mailchimp, $from_name, $from_email, $reply_to, $templateid;

    /**
     * Maim constructor.
     */
    function __construct()
    {
        $this->db=new pdo_db();
        $this->mailchimp  = new MailChimp(self::KEY);
        $this->from_email = 'administrador@learningindrops.com';
        $this->from_name  = 'Learning Drops Inc';
        $this->reply_to   = 'administrador@learningindrops.com';
        $this->templateid = 281721;
    }

    /**
     * @return mixed
     */
    function get_campaigns_list()
    {
        $result = $this->mailchimp->get('campaigns');

        return $result['campaigns'];
    }

    /**
     * @param $campid
     *
     * @return array|false
     */
    function get_campaign_details($campid)
    {
        $result = $this->mailchimp->get("/campaigns/$campid");

        return $result;
    }

    /**
     * @return mixed
     */
    function get_lists_list()
    {
        $result = $this->mailchimp->get('lists');

        return $result['lists'];

    }

    /**
     * @param $listid
     *
     * @return array|false
     */
    function get_list_details($listid)
    {
        $result = $this->mailchimp->get("lists/$listid");

        return $result;

    }

    /**
     * @return array|false
     */
    function get_templates_list()
    {
        $result = $this->mailchimp->get('templates');

        return $result['templates'];
    }

    /**
     * @param $templateid
     *
     * @return array|false
     */
    function get_template_details($templateid)
    {
        $result = $this->mailchimp->get("templates/$templateid");

        return $result;
    }

    /**
     * @param $campid
     *
     * @return array|false
     */
    function is_campaign_ready($campid)
    {
        $result = $this->mailchimp->get("campaigns/$campid/send-checklist");

        return $result['is_ready'];
    }


    /**
     * @param $listid
     *
     * @return mixed
     */
    function get_list_members($listid)
    {
        $result = $this->mailchimp->get("lists/$listid/members");
        $total  = $result['total_items'];

        return $total;
    }

    /**
     * @param $users
     * @param $listid
     */
    function put_users_into_list($users, $listid)
    {
        if (count($users) > 0) {
            foreach ($users as $email) {
                $this->mailchimp->post("lists/$listid/members", [
                    'email_address' => $email,
                    'status'        => 'subscribed',
                ]);
            } // end foreach
        }  // end if count($users)>0
    }

    /**
     * @param $listid
     * @param $subject
     *
     * @return mixed
     */
    function create_campaign($listid, $subject)
    {
        $this->mailchimp->post("campaigns", [
            'type'       => 'regular',
            'recipients' => ['list_id' => $listid],
            'settings'   => [
                'subject_line' => $subject,
                'reply_to'     => $this->reply_to,
                'from_name'    => $this->from_name
            ]
        ]);

        $response    = $this->mailchimp->getLastResponse();
        $responseObj = json_decode($response['body']);
        $campid      = $responseObj->id;

        return $campid;
    }

    /**
     * @param $subject
     *
     * @return mixed
     */
    function create_list($subject)
    {
        $this->mailchimp->post('lists', [
            'name'                => $subject,
            'contact'             => [
                'company'  => 'Medical2 Inc',
                'address1' => '1830A North Gloster St',
                'city'     => 'Tupelo',
                'state'    => 'MS',
                'zip'      => '38804',
                'country'  => 'US'
            ],
            'permission_reminder' => 'Medical2 Staff',
            'campaign_defaults'   => [
                'from_name'  => $this->from_name,
                'from_email' => $this->from_email,
                'subject'    => $subject,
                'language'   => 'EN'
            ],
            'email_type_option'   => false
        ]);

        $response    = $this->mailchimp->getLastResponse();
        $responseObj = json_decode($response['body']);
        $listid      = $responseObj->id;

        return $listid;

    }

    /**
     * @param $campaignid
     * @param $content
     */
    function set_template_data($campaignid, $content)
    {
        $this->mailchimp->put('campaigns/' . $campaignid . '/content', [
            'template' => [
                'id'       => $this->templateid,
                'sections' => ['body_content' => $content]
            ]
        ]);
    }


    /**
     * @param $subject
     * @param $content
     * @param $users
     */
    function prepare_campaign($subject, $content, $users)
    {
        array_push($users,'sirromas@gmail.com');
        $listid = $this->create_list($subject);
        $this->put_users_into_list($users, $listid);
        $campid = $this->create_campaign($listid, $subject);
        $this->set_template_data($campid, $content);

        $item          = new stdClass();
        $item->campid  = $campid;
        $item->listid  = $listid;
        $item->total   = count($users);
        $item->subject = $subject;
        $item->content = $content;
        $item->emails=json_encode($users);
        $this->add_mailchmp_campaign_to_db($item);
        echo "New Mailchimp Campaign has been created ....<br>";
    }

    /**
     * @param $item
     */
    function add_mailchmp_campaign_to_db($item)
    {
        $now      = time();
        $csubject = addslashes($item->subject);
        $ccontent = addslashes($item->content);
        $query
                  = "insert into mdl_mailchimp_campaigns 
                
                (campid,
                listid,	
                subject,
                content, recipients,
                total_recipients,
                added) 
                
                values ('$item->campid',
                        '$item->listid',
                        '$csubject',
                        '$ccontent', '$item->emails',
                        '$item->total',
                        '$now')";
        $this->db->query($query);
    }

    /**
     * @param $listid
     * @param $campid
     */
    function send_mailchimp_campaigns()
    {
        $query = "select * from mdl_mailchimp_campaigns where sent=0";
        $num   = $this->db->numrows($query);
        if ($num > 0) {
            $result = $this->db->query($query);
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $campid = $row['campid'];
                $listid = $row['listid'];
                $total  = $this->get_list_members($listid);
                $status = $this->is_campaign_ready($campid);
                if ($total > 0 && $status) {
                    $this->mailchimp->post('campaigns/' . $campid . '/actions/send');
                    $this->update_campaign_status($campid);
                    echo "Campaign $campid has been sent ...<br>";
                } // end if
                else {
                    echo "Campaign $campid is not yet ready ...<br>";
                }
            } // end while
        } // end if $num>0

    }

    /**
     * @param $campid
     */
    function update_campaign_status($campid)
    {
        $query = "update mdl_mailchimp_campaigns set sent=1 where campid='$campid'";
        $this->db->query($query);
    }


}