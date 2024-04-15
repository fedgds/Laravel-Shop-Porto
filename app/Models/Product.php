<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name',	'price', 'sale_price', 'image',	'category_id', 'slug', 'description', 'status', 'stock'];

    protected $table = 'products';

    public function getAllProducts()
    {
        $products = DB::table($this->table)
        ->orderBy('created_at', 'desc')
        ->get();
    }
    /**
     * The category that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    /**
     * Get all of the images for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(ImgProduct::class);
    }
    public function scopeSearch($query, $keywords)
    {
        if ($keywords) {
            return $query->where('name', 'like', '%' . $keywords . '%')
                        ->orWhere('description', 'like', '%' . $keywords . '%');
        }
        return $query;
    }

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['category_id']) && $filters['category_id'] != '0') {
            $query->where('category_id', $filters['category_id']);
        }
        if (isset($filters['status']) && $filters['status'] != '0') {
            $status = $filters['status'] == 'active' ? 1 : 0;
            $query->where('status', $status);
        }
        return $query;
    }
}
