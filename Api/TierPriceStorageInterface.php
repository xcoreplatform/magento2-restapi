<?php

namespace Dealer4dealer\Xcore\Api;

interface TierPriceStorageInterface
{
    public function update(array $prices);

    public function replace(array $prices);

    public function delete(array $prices);
}