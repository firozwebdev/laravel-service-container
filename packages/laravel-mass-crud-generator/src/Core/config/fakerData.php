<?php

return [
    'fakerDataWithType' => [
        'increments' => '$this->faker->unique()->randomNumber()',
        'foreignId' => '$this->faker->numberBetween(1, 50)',
        'string' => '$this->faker->sentence()',
        'text' => '$this->faker->paragraph()',
        'integer' => '$this->faker->numberBetween(0, 100)',
        'float' => '$this->faker->randomFloat(2, 0, 1000)',
        'decimal' => '$this->faker->randomFloat(2, 0, 1000)',
        'boolean' => '$this->faker->boolean()',
        'date' => '$this->faker->date()',
        'time' => '$this->faker->time()',
        'datetime' => '$this->faker->dateTime()',
        'timestamp' => '$this->faker->dateTime()',
        'year' => '$this->faker->year()',
        'month' => '$this->faker->month()',
        'day' => '$this->faker->dayOfMonth()',
        'enum' => function ($elements) {
            return '$this->faker->randomElement(' . json_encode($elements) . ')';
        },
        'image' => '$this->faker->imageUrl(640, 480, "animals", true)', // Generate a random image URL
    ],

    'fakerDataWithColumn' => [
        'phone' => '$this->faker->phoneNumber()',
        'cell' => '$this->faker->e164PhoneNumber()',
        'email' => '$this->faker->unique()->safeEmail()',
        'url' => '$this->faker->url()',
        'ipAddress' => '$this->faker->ipv4()',
        'macAddress' => '$this->faker->macAddress()',
        'uuid' => '$this->faker->uuid()',
        'password' => '$this->faker->password()',
        'color' => '$this->faker->safeColorName()',
        'country' => '$this->faker->country()',
        'city' => '$this->faker->city()',
        'streetAddress' => '$this->faker->streetAddress()',
        'postcode' => '$this->faker->postcode()',
        'latitude' => '$this->faker->latitude()',
        'longitude' => '$this->faker->longitude()',
        'company' => '$this->faker->company()',
        'jobTitle' => '$this->faker->jobTitle()',
        'creditCardNumber' => '$this->faker->creditCardNumber()',
        'iban' => '$this->faker->iban()',
        'currencyCode' => '$this->faker->currencyCode()',
        'languageCode' => '$this->faker->languageCode()',
        'address' => '$this->faker->address()',
        'created_at' => '$this->faker->dateTime()',
        'updated_at' => '$this->faker->dateTime()',
        'first_name' => '$this->faker->firstName()',
        'last_name' => '$this->faker->lastName()',
        'name' => '$this->faker->firstName() . " " . $this->faker->lastName()',
        'image' => '$this->faker->imageUrl(640, 480, "animals", true)', // Generate a random image URL
    ],
];
