<?php

namespace App\Constants;

class GlobalConstant
{
    const JOURNAL_IN = 'in';
    const JOURNAL_OUT = 'out';
    const JOURNAL_CATEGORIES = [self::JOURNAL_IN, self::JOURNAL_OUT];

    const PAYMENT_CATEGORY_MONTH = 'month';
    const PAYMENT_CATEGORY_FREE = 'free';
    const PAYMENT_CATEGORY_ALL = 'all';
    const PAYMENT_CATEGORY_CLASS = 'class';
    const PAYMENT_CATEGORY_CUSTOM = 'custom';
    const PAYMENT_CATEGORY_TYPE = [self::PAYMENT_CATEGORY_FREE, self::PAYMENT_CATEGORY_MONTH];
    const PAYMENT_CATEGORY_GROUPS = [self::PAYMENT_CATEGORY_ALL, self::PAYMENT_CATEGORY_CLASS, self::PAYMENT_CATEGORY_CUSTOM];

    const GENDER_MALE = 'L';
    const GENDER_FEMALE = 'P';
    const GENDER = [self::GENDER_MALE, self::GENDER_FEMALE];

    const ROLE_STUDENT = 'Siswa';
    const JOURNAL_CATEGORY_SISWA = 'Pembayaran Siswa';

    const ADMIN = 'Administrator';

    const PAYMENT_MONTHS = [
        'january',
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december'
    ];

    const PAYMENT_LISTS = ['free', ...self::PAYMENT_MONTHS];

    const PAID = 'Lunas';
    const NOT_PAID = 'Belum Lunas';
    const PAYMENT_STATUS = [self::PAID, self::NOT_PAID];
}
