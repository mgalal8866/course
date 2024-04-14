<?php

namespace App\Repositoryinterface;

interface CollectPointsRepositoryinterface
{
    public function convert_points();
    public function collect_points($coupon_id,$order_id);
}
