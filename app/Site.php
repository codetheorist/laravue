<?php
namespace App;
// use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\UptimeMonitor\Models\Monitor as Monitor;
use Spatie\Url\Url;
use Illuminate\Database\Eloquent\Model;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;
use Spatie\UptimeMonitor\Exceptions\CannotSaveMonitor;
use Spatie\UptimeMonitor\Models\Enums\CertificateStatus;
use Spatie\UptimeMonitor\Models\Traits\SupportsUptimeCheck;
use Spatie\UptimeMonitor\Models\Presenters\MonitorPresenter;
use Spatie\UptimeMonitor\Models\Traits\SupportsCertificateCheck;

class Site extends Monitor {
    protected $table = 'monitors';

    use SupportsUptimeCheck;
    use SupportsCertificateCheck;
    use MonitorPresenter;

    protected $guarded = [];

    protected $dates = [
        'uptime_last_check_date',
        'uptime_status_last_change_date',
        'uptime_check_failed_event_fired_on_date',
        'certificate_expiration_date',
    ];

    protected $casts = [
        'uptime_check_enabled' => 'boolean',
        'certificate_check_enabled' => 'boolean',
    ];

    public function scopeEnabled($query)
    {
        return $query
            ->where('uptime_check_enabled', true)
            ->orWhere('certificate_check_enabled', true);
    }

    /**
     * @return \Spatie\Url\Url|null
     */
    public function getUrlAttribute()
    {
        if (! isset($this->attributes['url'])) {
            return;
        }

        return Url::fromString($this->attributes['url']);
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function (Monitor $monitor) {
            if (static::alreadyExists($monitor)) {
                throw CannotSaveMonitor::alreadyExists($monitor);
            }
        });
    }

    public function isHealthy()
    {
        if ($this->uptime_check_enabled && in_array($this->uptime_status, [UptimeStatus::DOWN, UptimeStatus::NOT_YET_CHECKED])) {
            return false;
        }

        if ($this->certificate_check_enabled && $this->certificate_status === CertificateStatus::INVALID) {
            return false;
        }

        return true;
    }

    /**
     * @return $this
     */
    public function enable()
    {
        $this->uptime_check_enabled = true;

        if ($this->url->getScheme() === 'https') {
            $this->certificate_check_enabled = true;
        }

        $this->save();

        return $this;
    }

    /**
     * @return $this
     */
    public function disable()
    {
        $this->uptime_check_enabled = false;
        $this->certificate_check_enabled = false;

        $this->save();

        return $this;
    }

    protected static function alreadyExists(Monitor $monitor): bool
    {
        $query = static::where('url', $monitor->url);

        if ($monitor->exists) {
            $query->where('id', '<>', $monitor->id);
        }

        return (bool) $query->first();
    }

}
