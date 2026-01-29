<?php

namespace App\Helpers;

class RoleHelper
{
    /**
     * Role ID → Role Name ম্যাপ
     */
    protected static array $map = [
        1  => 'সভাপতি',
        2  => 'সহ-সভাপতি',
        3  => 'সহ-সভাপতি (মহিলা)',
        4  => 'সাধারণ সম্পাদক',
        5  => 'সহ-সাধারণ সম্পাদক',
        6  => 'অর্থ সম্পাদক',
        7  => 'প্রচার ও প্রকাশনী সম্পাদক',
        8  => 'সাহিত্য ও সাংস্কৃতিক সম্পাদক',
        9  => 'দপ্তর সম্পাদক',
        10 => 'ক্রীড়া সম্পাদক',
        11 => 'সাংগঠনিক সম্পাদক',
        12 => 'সমাজকল্যাণ সম্পাদক',
        13 => 'শিক্ষা সম্পাদক',
        14 => 'তথ্য ও প্রযুক্তি উন্নয়ন সম্পাদক',
        15 => 'মহিলা বিষয়ক সম্পাদক',
        16 => 'সাধারণ কার্যকরী সদস্য',
    ];

    /**
     * Role ID দিয়ে Role Name রিটার্ন করবে
     */
    public static function get(int $roleId): string
    {
        return self::$map[$roleId] ?? 'অজানা পদবী';
    }

    /**
     * সরাসরি echo করার জন্য
     */
    public static function echo(int $roleId): void
    {
        echo self::get($roleId);
    }

    public static function all(): array
    {
        return self::$map;
    }
}