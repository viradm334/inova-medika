<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'Admin';
    case PETUGAS_PENDAFTARAN = 'Petugas Pendaftaran';
    case DOKTER = 'Dokter';
    case KASIR = 'Kasir';
}
