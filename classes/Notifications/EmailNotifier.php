<?php
class EmailNotifier implements SplObserver
{
    public function update(SplSubject $s): void
    {
        $d = $s->getData();
        // mail($d['email'], 'Rezerwacja #'.$d['id'], 'Status: '.$d['status']);
    }
}
