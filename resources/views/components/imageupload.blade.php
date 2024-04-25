
@props([
    'imagenew' => null,
    'tlabel' => null,
    'imageold' => 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIAHkAtQMBIgACEQEDEQH/xAAcAAEAAwEBAQEBAAAAAAAAAAAABQYHBAMBCAL/xAA5EAABAwMCAgYGCAcAAAAAAAAAAQIDBAURBiESMQcTFEFRgTZhcZOhsiIyUnSCkdHhFRdUYqKxwf/EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwDcAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABQAAGwAAAAAAAAAAAAAAAAAAAAABUekXtLqO3Q0Uz4ZZqtI0cxyt3VFxv7cHDTXqW63TS0yudG9VqIqqJHKicbWt5p8d/EntUW2quD7U6kYjkp61k0mXImGpz9pGS6ZqYNa090o2t7ArnSSt4scD1aqKqJ69gOO00E2rUuFxrK6rhxO6KlZDKrUiROS48ya0Hcqi42Re2vWSoppnU7pF5vwiLn4kdT2zUFhkrqazU9NVUdTIskTpZeFYVXnlO8m9KWd1ktLaaWRJJ3yLLM5vJXrzx+SAU5tVULo++L2mbrP4qsbH9YuWpxM2Re5D+pbpWTaPhtnXSJcO1vpHvRy8WI8uVc8+SIdiaauqWOro+pZ1s127SidamOq23+HI7WaYnbqituGG9kfG90LeLdJXt4XLju79/WBySXSaHo1ppI5JHVVRGkEb0cquVyuVM555winvpuvmtdvvlHWSyTy2p7ncT3Kqvarcpuvs+JyQ6XuVRbrBbK+JG0tLJI+qVkqIvNeHGN/wAvE76TS7qK/VSUzHLaq2jWKZXy8Tkf57r+4EXTUsFXaoLxqa+VsD6xVWJIp1jYxN8IiInPG581LVUbtTUDau4VkVufb2vR8ErkVy5dwrt4nrJZdRU9klsLaSkrKbdsFUsvA5jVXPJe86aiz3uku1srqGkgqVprcymej5eFFcmcgWPTnZf4TCtBPPPTrxKySdyq9d15535kmcVpfWyUbXXKnip6jK5jifxIid252gAAAAAAAAAAAAAAAAAAAPiqicyC1Bqq3WKRkVSskk7m8SRRIiqieK55FYvXSFT1drqKeipqiOaVisa9+MNzsq7LzwBO1evbHTVD4esnlVi4V0ceW59S954/zEsf2av3X7mT8kAGxW3W9luNXHSxyyxSyLhnXR8KOXwyWQ/PKLhdlVFTdFTmhpNJ0k0jaSJKqjqHTo1EkVnDhV8eYF9BD6f1HQ36N7qNzmvj+vFImHJ6/YTAAAAAAAAAAAAAAAAAAAAAABjfSCqrqysyvJI0/wAUK6WHX/pZXfg+RCvtaj3Naq4Ryoir4AXLR2i0utO2vubnspXbxRNXCyJ4qvchZ0sWj5HrRMZRrMm3C2deP/eT5ruoltmk0ioVWNHOZBlq4wzC/pjzMmxjGNu9FTYC06x0k+xo2rpXOkonLheL60S9yKvenrI7TdPZaiomS+1TqdjWIsStcrcrnfOymhW+V146PXPr/pOkpJEc53fw5wvwQyVF29u4Fx6LlxqKdqKuOzO2z/c3BqplHRb6Ry/dXfM01cAAAAAAAAAAAAAAAAAAAAAAxrX/AKWV34PkQr3PYuXSLZq1L5JcIqeSWmnY36bGqvC5ExhccuRUuy1PdTT+7UDUNOXWg1TYltdw4VqUYjJY1XCvxye044+jOlSq45LjM6DO8aRojlTwV2f+GeMp6tjkcyCoa5N0VGORUJB10v74eqdVXFWfZy8C7a4vdJbLOtjtyt657Ejc1nKKPvz61TYzM9VpqpVytNMqquc9W7I7LU/00/u1/QC1dFvpHL91d8zTVzOejGz1sFdPcamGSGHqurZ1jVar1VUzsvdsaMAAAAAAAAAAAAAAAAAAAAAAFHmAA8x5gAPMeYAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAB//Z',
    'height' => '100',
    'width' => '100',
])

<label class="form-label" for="{{ $imagenew }}">{{ $tlabel ?? __('tran.image') }} : </label>

<div class="">
    <img src="{{ $imagenew ? $imagenew->temporaryUrl() : $imageold }}" id="account-upload-img"
        class="uploadedAvatar rounded me-50" alt="image" height="{{ $height }}" width="{{ $width }}"
        style="display: block;border: 1px solid #b44040;" />

    <div x-data="{ isUploading: false, progress: 5, name: null }"
        x-on:livewire-upload-start="isUploading = true; progress = 0"
        x-on:livewire-upload-finish="isUploading = false; progress = 0"
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress">

        <div class="overflow-hidden position-relative w-64 ">
            <label class="btn btn-success" x-show="!name">
                <span class="ml-2">اختر صورة </span>
                <input class="hidden" accept=".png, .jpg, .jpeg, .gif" type="file" {{ $attributes }}
                    x-on:change="name = $event.target.files[0].name">
            </label>

            <div class="text-gray-500" x-show="name">
                <span x-show="isUploading">Uploading... Please wait.</span>
                <div class="d-flex align-items-center" x-show="!isUploading">
                    <div  style=" word-wrap: break-word;"  class="d-flex flex-grow-1  overflow-hidden mr-2 ">
                        <span style=" word-wrap: break-word;" x-text="name"></span>
                    </div>
                        <span  x-show="!isUploading">
                            <button type="button"
                        class="btn btn-sm btn-danger d-inline-flex align-items-center justify-content-center rounded-circle
                        bg-red-600 hover:bg-red-800 text-white shadow-lg hover-shadow-xl
                        transition duration-150 ease-in-out focus:bg-red-700 outline-none focus-outline-none"
                        style="height: 2rem; width: 2rem; "
                        x-on:click="progress = 0; isUploading = false; name = null; $wire.file = null; $wire.set('{{ $attributes->wire('model')->value() }}', '');">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </span>
                </div>
            </div>
        </div>
        <div x-show="isUploading"  >
            <x-loading></x-loading>
        </div>
        <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
            <div class="progress-bar bg-success  progress-bar-striped" role="progressbar" aria-valuenow="40"
                aria-valuemin="0" aria-valuemax="100" :style="`width: ${progress}%`">
                <span class="sr-only">40% Complete (success)</span>
            </div>
        </div>
    </div>
</div>
