@props(['car'=>''])

<div class="car-item card">
    <a href="{{ route('car.show', $car->id) }}"> <!-- Dynamically pass the car's ID -->
        <img src="{{ $car->primaryImage ? $car->primaryImage->image_path : '/path/to/default-image.png' }}" alt="Car Image" class="car-item-img rounded-t" />
    </a>
    <div class="p-medium">
        <div class="flex items-center justify-between">
            <small class="m-0 text-muted">{{ optional($car->city)->name ?? 'Unknown City' }}</small> <!-- Safe null check -->
            <button class="btn-heart">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 20px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </button>
        </div>
        <h2 class="car-item-title">{{ $car->year }} - {{ optional($car->maker)->name ?? 'Unknown Maker' }}</h2> <!-- Safe null check -->
        <p class="car-item-price">${{ number_format($car->price, 2) }}</p> <!-- Format price with commas -->
        <hr />
        <p class="m-0">
            <span class="car-item-badge">{{ optional($car->carType)->name ?? 'Unknown Type' }}</span> <!-- Safe null check -->
            <span class="car-item-badge">{{ optional($car->fuelType)->name ?? 'Unknown Fuel' }}</span> <!-- Safe null check -->
        </p>
    </div>
</div>
