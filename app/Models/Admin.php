<?php

namespace App\Models;

use App\Models\Traits\Roleable;
use App\Notifications\AdminNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable, Roleable;

    public $timestamps = true;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'status', 'last_login_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at', 'last_login_at'];

    // Методы для работы с ролями и правами, если необходимы
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function isAdmin()
    {
        return $this->role === 'admin'; // или другая логика определения администратора
    }

    public function assignRole($role)
    {
        $this->role = $role;
        $this->save();
    }

    public function revokeRole()
    {
        $this->role = 'user'; // Замените на вашу логику по умолчанию
        $this->save();
    }

    public function hasPermission($permission)
    {
        // Предположим, что у администратора есть связь с ролями, и у ролей - с разрешениями
        return $this->roles->each(function ($role) use ($permission) {
            if ($role->permissions->contains('key', $permission)) {
                return true;
            }
        }) ?? false;
    }

    public function logAction($action, $details = [])
    {
        $logEntry = [
            'admin_id' => $this->id,
            'action'   => $action,
            'details'  => json_encode($details),
            'timestamp' => now(),
        ];

        // Здесь можно использовать локальное хранилище, например, Eloquent Model для логов
        // AdminActionLog::create($logEntry);

        // Или внешний сервис, например, отправка данных в систему аналитики
        // ExternalAnalyticsService::logAdminAction($logEntry);
    }
    public function validateCredentials(array $data)
    {
        $rules = [
            'email' => 'required|email|unique:admins,email,' . $this->id,
            'password' => 'required|min:8',
            // Другие правила валидации
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        return true;
    }
    public function sendNotification($message)
    {
        // Использование встроенной системы уведомлений Laravel
        $notification = new AdminNotification($message);
        $this->notify($notification);

        // Или интеграция с внешним сервисом уведомлений
        // ExternalNotificationService::send($this->email, $message);
    }


}
