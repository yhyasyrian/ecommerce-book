<?php

namespace App\Enums;

enum RolesEnum:int
{
    case USER = 0;
    case ADMIN = 1;
    case SUPER_ADMIN = 2;
    case OWNER = 3;
    public static function values():array
    {
        return array_map(fn(RolesEnum $rolesEnum) => $rolesEnum->value,self::cases());
    }
    public static function toArrayWithLabel():array
    {
        return [
            [self::USER->value, 'مستخدم'],
            [self::ADMIN->value, 'مدير'],
            [self::SUPER_ADMIN->value, 'مدير عام'],
            [self::OWNER->value, 'مالك الموقع'],
        ];
    }
    public static function getRole(int $keyRole):self
    {
        foreach (self::cases() as $case)
            if ($case->value == $keyRole) return $case;
        return self::USER;
    }
    public function checkIfCan(self|int $newRole):bool
    {
        if (is_int($newRole)) $newRole = self::getRole($newRole);
        return $this->value > $newRole->value;
    }
    public function checkIfCanEqual(self|int $newRole):bool
    {
        if (is_int($newRole)) $newRole = self::getRole($newRole);
        return $this->value >= $newRole->value;
    }
    public function getName():string
    {
        foreach (self::toArrayWithLabel() as $key => $arrayWithLabel){
            if ($arrayWithLabel[0] === $this->value) return $arrayWithLabel[1];
        }
        return 'مستخدم';
    }
}
