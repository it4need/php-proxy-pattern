<?php

namespace ProxyPatterns\RemoteProxy;

class ReportSubject implements IReport
{
    private $owner;
    private $id;
    private $score;

    public function __construct($id, $owner, $score)
    {
        $this->setId($id);
        $this->setOwner($owner);
        $this->setScore($score);
    }

    private function setId($id)
    {
        $this->id = $id;
    }

    private function setOwner($owner)
    {
        $this->owner = $owner;
    }

    private function setScore($score)
    {
        $this->score = $score;
    }

    public function generateReport()
    {
        $string = '';
        foreach (['id', 'owner', 'score'] as $property) {
            $uc_property = ucfirst($property);
            $string .= $uc_property . ': ' . $this->{"get{$uc_property}"}() . "\n";
        }
        return rtrim($string);
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getScore()
    {
        return $this->score;
    }
}