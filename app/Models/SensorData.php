<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webit\Math\Fft\FftCalculatorRadix2;
use Webit\Math\Fft\Dimension;
use Webit\Math\ComplexNumber\ComplexArray;

class SensorData extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_file_id', 'X', 'Y', 'Z'
    ];

    public function file()
    {
        return $this->belongsTo(DataFile::class);
    }

    public static function FFT($file_id, Array $args)
    {
        $data = self::where('data_file_id', $file_id)
            ->pluck($args[0]);

        // Convert the collection to an array
        $dataArray = $data->toArray();

        // Calculate the next power of 2 greater than or equal to count($data)
        $count = count($dataArray);
        $nextPowerOf2 = pow(2, ceil(log($count) / log(2)));

        // Pad the data array with zeros to reach the next power of 2
        $paddedData = array_pad($dataArray, $nextPowerOf2, 0);

        // Create a ComplexArray from the padded array
        $signal = ComplexArray::create($paddedData);

        // Create the FFT calculator
        $calculator = new FftCalculatorRadix2();

        // Calculate the FFT
        $fft = $calculator->calculateFft($signal, Dimension::create(count($paddedData)));

        return $fft;
    }
}
