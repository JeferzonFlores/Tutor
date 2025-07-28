<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'module_id',
        'nombre',
        'orden',
        'description',
        'content_text',
        'content_image_video_path',
        'content_document_path',
        'content_link',
        'is_published',
        // 'teacher_id' is commented out if it's not being used directly in Lesson creation/update from forms,
        // but rather managed through relationships or other means.
        // Uncomment if you intend to directly assign teacher_id via mass assignment.
        // 'teacher_id',
    ];

    /**
     * Define the attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * A lesson belongs to a module.
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * A lesson can belong to a teacher.
     * Uncomment if you have a direct relationship from Lesson to Teacher.
     */
    /*
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    */
}
