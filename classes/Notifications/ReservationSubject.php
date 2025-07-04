<?php
class ReservationSubject implements SplSubject
{
    private array $observers = [];
    private array $data = [];

    public function attach(SplObserver $o): void { $this->observers[] = $o; }
    public function detach(SplObserver $o): void
    {
        $this->observers = array_filter($this->observers, fn($obs) => $obs !== $o);
    }
    public function notify(): void
    {
        foreach ($this->observers as $o) $o->update($this);
    }

    public function setData(array $data): void { $this->data = $data; $this->notify(); }
    public function getData(): array     { return $this->data; }
}
