<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('appuntamenti', function () {
    return true;
});
