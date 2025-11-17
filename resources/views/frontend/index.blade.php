{{-- //memakai komponen layout guest --}}
<x-layouts.guest>
    <h1 class="text-center font-bold text-2xl">BILLING BERHASIL</h1>
    <div class="card bg-base-100 w-96 shadow-sm">
        <figure>
            <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp" alt="Shoes" />
        </figure>
        <div class="card-body">
            <h2 class="card-title">Card Title</h2>
            <p>A card component has a figure, a body part, and inside body there are title and actions parts</p>
            <div class="card-actions justify-end">
                <button class="btn btn-primary">Buy Now</button>
            </div>
        </div>
    </div>

    <div class="hover-3d">
        <figure class="max-w-100 rounded-2xl">
            <img src="https://img.daisyui.com/images/stock/creditcard.webp" alt="3D card" />
        </figure>
        <!-- 8 empty divs needed for the 3D effect -->
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</x-layouts.guest>
