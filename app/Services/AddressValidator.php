<?php

namespace App\Services;

interface AddressValidator {
    public function validate(array $addressData): bool;
}