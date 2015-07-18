<?php

use MPWAR\Database\Database;

Database::mysql("main_db")
    ->host(getenv("DB_HOST"))
    ->database(getenv("DB_NAME"))
    ->user(getenv("DB_USER"))
    ->password(getenv("DB_PASSWORD"));
