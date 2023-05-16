<?php

class Event
{
    private int $id;
    private string $name;
    private DateTime $startDate;
    private DateTime $endDate;
    private string $description;
    private string $type;
    private string $location;
    private int $phoneNumber;
    private float $longitude;
    private float $latitude;

    function __construct(
        int $id,
        string $name,
        DateTime $startDate,
        DateTime $endDate,
        string $description,
        string $type,
        string $location,
        int $phoneNumber,
        float $longitude,
        float $latitude
    ) {
        $this->$id = $id;
        $this->$name = $name;
        $this->$startDate = $startDate;
        $this->$endDate = $endDate;
        $this->$description = $description;
        $this->$type = $type;
        $this->$location = $location;
        $this->$phoneNumber = $phoneNumber;
        $this->$longitude = $longitude;
        $this->$latitude = $latitude;
    }
}
