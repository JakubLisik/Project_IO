<?php
class SmsNotifier implements SplObserver
{
    public function update(SplSubject $s): void
    {
        $d = $s->getData();
        // SmsGateway::send($d['phone'], "Rezerwacja {$d['id']} – {$d['status']}");
    }
}
