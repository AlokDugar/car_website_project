<x-app-layout title="Watchlist"/>
    <main>
      <!-- New Cars -->
      <section>
        <div class="container">
          <h2>My Favourite Cars</h2>
          <div class="car-items-listing">
            @foreach ($cars as $car)
                <x-car-item :$car :isWatchlist="true"/>
            @endforeach
          </div>
          {{$cars->onEachSide(1)->links()}}
        </div>
      </section>
      <!--/ New Cars -->
    </main>

