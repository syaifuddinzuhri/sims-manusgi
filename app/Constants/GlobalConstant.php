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
    const PAYMENT_CATEGORY_GROUP = 'group';
    const PAYMENT_CATEGORY_STUDENT = 'student';
    const PAYMENT_CATEGORY_TYPE = [self::PAYMENT_CATEGORY_FREE, self:: PAYMENT_CATEGORY_MONTH];
    const PAYMENT_CATEGORY_GROUPS = [self::PAYMENT_CATEGORY_ALL, self:: PAYMENT_CATEGORY_GROUP, self::PAYMENT_CATEGORY_STUDENT];

    const GENDER_MALE = 'L';
    const GENDER_FEMALE = 'P';
    const GENDER = [self::GENDER_MALE, self::GENDER_FEMALE];
}
