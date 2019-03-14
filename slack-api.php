<?php

class SlackApi {
    public  $ch;

    function __construct($hook) {
        $this->ch = curl_init($hook);    
    }

    public function notify($message, $title) {
        $data = json_encode(array(
            "text" => "$title```$message```"
        ));
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($this->ch);
        curl_close($this->ch);

        return $result;
    }
}

// 
// Example message will post "Hello world" into the random channel

$contactSlack = new SlackApi("https://hooks.slack.com/services/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");

$contactSlack->notify('Nombre: Test
Apellido: Test
Email: Test',
'*Nuevo contacto recibido:*');