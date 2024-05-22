 @extends('layouts.dashboard.app')
 @section('content')


     <div wire:ignore.self>
         @push('csslive')
             <meta name="csrf-token" content="{{ csrf_token() }}">

             <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/forms/wizard/bs-stepper.min.css') }}">
             @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                 <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-rtl/plugins/forms/form-wizard.min.css') }}">
             @else
                 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-wizard.min.css') }}">
             @endif
         @endpush

         <section class="horizontal-wizard">
             <div class="bs-stepper horizontal-wizard-example">
                 <div class="bs-stepper-header" role="tablist">
                     <div class="step {{ $currentPage == 1 ? 'active' : 'crossed' }}" wire:click.prevent="goToPage('1')">
                         <button type="button" class="step-trigger">
                             <span class="bs-stepper-box">1</span>
                             <span class="bs-stepper-label">
                                 <span class="bs-stepper-title">{{ __('tran.datacourse') }}</span>
                                 {{-- <span class="bs-stepper-subtitle">{{ $pages[1]['subheading'] }}</span> --}}
                             </span>
                         </button>
                     </div>
                     <div class="line">
                         <i
                             class="fas fa-chevron-{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'left' : 'right' }} font-medium-2"></i>
                     </div>
                     <div class="step {{ $currentPage == 2 ? 'active' : 'crossed' }}">
                         <button type="button" class="step-trigger">
                             <span class="bs-stepper-box">2</span>
                             <span class="bs-stepper-label">
                                 <span class="bs-stepper-title">{{ __('tran.attached') }}</span>
                                 {{-- <span class="bs-stepper-subtitle">{{ $pages[2]['subheading'] }}</span> --}}
                             </span>
                         </button>
                     </div>
                     <div class="line">
                         <i
                             class="fas fa-chevron-{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'left' : 'right' }} font-medium-2"></i>
                     </div>
                     <div class="step {{ $currentPage == 3 ? 'active' : 'crossed' }}">
                         <button type="button" class="step-trigger">
                             <span class="bs-stepper-box">3</span>
                             <span class="bs-stepper-label">
                                 <span class="bs-stepper-title">{{ __('tran.lessons') }}</span>
                                 {{-- <span class="bs-stepper-subtitle">{{ $pages[3]['subheading'] }}</span> --}}
                             </span>
                         </button>
                     </div>
                     <div class="line">
                         <i
                             class="fas fa-chevron-{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'left' : 'right' }} font-medium-2"></i>
                     </div>
                     <div class="step  {{ $currentPage == 4 ? 'active' : 'crossed' }}">
                         <button type="button" class="step-trigger">
                             <span class="bs-stepper-box">4</span>
                             <span class="bs-stepper-label">
                                 <span class="bs-stepper-title">{{ __('tran.setcourse') }}</span>
                                 {{-- <span class="bs-stepper-subtitle">{{ $pages[4]['subheading'] }}</span> --}}
                             </span>
                         </button>
                     </div>
                 </div>
                 <div class="bs-stepper-content">

                     {{-- <form enctype="multipart/form-data"> --}}


                     {{-- <div class="main">
                         <div class="mb-1 row">
                             <div class="col-md-2 form-check form-check-inline ">
                                 <select class="form-select" id="mainstages">
                                     @foreach ($stage as $q)
                                         <option value="{{ $q->id }}"> {{ $q->name }} </option>
                                     @endforeach
                                 </select>

                             </div>
                         </div>
                     </div> --}}
                     <div id="mainContainer">
                         <button id="addCategoryBtn" class="btn btn-warning mb-4 mt-2">اضافة مرحلة رئيسية</button>
                     </div>


                     <div class="d-flex justify-content-between">
                         <button wire:loading.attr="disabled"
                             class="btn {{ $currentPage > 1 ? 'btn-primary' : 'btn-outline-secondary' }} btn-prev"
                             {{ $currentPage == 1 ? 'disabled' : '' }} wire:click.prevent="goToPerviousPage">
                             <i
                                 class="fas fa-arrow-{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'right' : 'left' }}  align-middle ms-sm-25 ms-0"></i>
                             <span class="align-middle d-sm-inline-block d-none">{{ __('tran.previous') }}</span>
                         </button>
                         {{ $currentPage }}
                         @if ($currentPage === 4)
                             <button type="submit" class="btn btn-success btn-submit">
                                 {{ __('tran.submit') }}</button>
                         @else
                             <button class="goToNextPage btn btn-primary btn-next">
                                 <span class="align-middle d-sm-inline-block d-none">{{ __('tran.next') }}</span>
                                 <i
                                     class="fas fa-arrow-{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'left' : 'right' }} align-middle me-sm-25 me-0"></i>
                             </button>
                         @endif
                     </div>
                     {{-- </form> --}}
                 </div>
             </div>
         </section>
     </div>
 @endsection
 @push('csslive')
     {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" /> --}}

     <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/forms/select/select2.min.css') }}">
 @endpush
 @push('jslive')
     <script>
         document.addEventListener('DOMContentLoaded', () => {
             const mainContainer = document.getElementById('mainContainer');
             const addCategoryBtn = document.getElementById('addCategoryBtn');

             // Function to fetch categories from API
             const fetchCategories = async () => {
                 try {
                     const response = await fetch(
                     'https://alyusr.academy/ar/dashboard/page?id='); // Replace with your API endpoint
                     const categories = await response.json();
                     return categories;
                 } catch (error) {
                     console.error('Error fetching categories:', error);
                     return [];
                 }
             };

             // Function to fetch subcategories from API based on selected category
             const fetchSubcategories = async (categoryId) => {
                 try {
                     const response = await fetch(
                     `https://alyusr.academy/ar/dashboard/page?id=${categoryId}`); // Replace with your API endpoint
                     const subcategories = await response.json();
                     return subcategories;
                 } catch (error) {
                     console.error('Error fetching subcategories:', error);
                     return [];
                 }
             };

             // Function to populate categories
             const populateCategories = async (categorySelect) => {
                 const categories = await fetchCategories();
                 categorySelect.innerHTML = `<option value="">Select Category</option>`;
                 categories.forEach(category => {
                     const option = document.createElement('option');
                     option.value = category.id; // Assuming the category has an 'id' field
                     option.textContent = category.name; // Assuming the category has a 'name' field
                     categorySelect.appendChild(option);
                 });
             };

             addCategoryBtn.addEventListener('click', () => {
                 const categoryContainer = document.createElement('div');
                 categoryContainer.classList.add('container', 'mb-3', 'p-3', 'border', 'border-primary',
                     'rounded');

                 const form = document.createElement('form');
                 form.action =
                 'https://alyusr.academy/ar/dashboard/formsub'; // Replace with your form submission endpoint
                 form.method = 'POST';

                 // Add CSRF token input
                 const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                 const csrfInput = document.createElement('input');
                 csrfInput.type = 'hidden';
                 csrfInput.name = '_token';
                 csrfInput.value = csrfToken;
                 form.appendChild(csrfInput);

                 const categoryRow = document.createElement('div');
                 categoryRow.classList.add('row', 'mb-1');

                 const col = document.createElement('div');
                 col.classList.add('col-md-6');

                 const categorySelect = document.createElement('select');
                 categorySelect.classList.add('form-select', 'mb-1');
                 categorySelect.name = 'category'; // Name added to category select
                 col.appendChild(categorySelect);
                 categoryRow.appendChild(col);

                 const subcategoryRow = document.createElement('div');
                 subcategoryRow.classList.add('row', 'mb-3');

                 const subcategoryCol = document.createElement('div');
                 subcategoryCol.classList.add('col-md-6');

                //  const subcategorySelect = document.createElement('select');
                //  subcategorySelect.classList.add('form-select', 'mb-3');
                //  subcategorySelect.name = 'subcategory'; // Name added to subcategory select
                //  subcategorySelect.innerHTML = `<option value="">Select Subcategory</option>`;
                //  subcategoryCol.appendChild(subcategorySelect);
                //  subcategoryRow.appendChild(subcategoryCol);

                 const addSubcategoryBtn = document.createElement('button');
                 addSubcategoryBtn.textContent = 'اضافة قسم فرعى';
                 addSubcategoryBtn.classList.add('btn', 'btn-secondary', 'mb-1');
                 addSubcategoryBtn.type = 'button'; // Ensure it doesn't trigger form submission

                 subcategoryRow.appendChild(addSubcategoryBtn);

                 const dynamicInputsContainer = document.createElement('div');
                 dynamicInputsContainer.classList.add('container');

                 categoryContainer.appendChild(categoryRow);
                 categoryContainer.appendChild(subcategoryRow);
                 categoryContainer.appendChild(dynamicInputsContainer);
                 form.appendChild(categoryContainer);
                 mainContainer.appendChild(form);

                 const submitBtn = document.createElement('button');
                 submitBtn.textContent = 'Submit';
                 submitBtn.classList.add('btn', 'btn-primary', 'mt-3');
                 submitBtn.type = 'submit';

                 form.appendChild(submitBtn);

                 // Populate categories when the category select is added
                 populateCategories(categorySelect);

                 // Event listener for category select change
                 categorySelect.addEventListener('change', async () => {
                     const selectedCategory = categorySelect.value;


                     if (selectedCategory) {
                         const subcategories = await fetchSubcategories(selectedCategory);
                         subcategories.forEach(subcat => {
                             const option = document.createElement('option');
                             option.value = subcat
                             .id; // Assuming the subcategory has an 'id' field
                             option.textContent = subcat
                             .name; // Assuming the subcategory has a 'name' field
                            //  subcategorySelect.appendChild(option);
                         });
                     }
                 });

                 addSubcategoryBtn.addEventListener('click', (event) => {
                     event.preventDefault(); // Prevent form submission
                     const selectedCategory = categorySelect.value;
                     if (selectedCategory) {
                         const subcategoryWrapper = document.createElement('div');
                         subcategoryWrapper.classList.add('row', 'mb-1');

                         const subcategoryCol1 = document.createElement('div');
                         subcategoryCol1.classList.add('col-md-4', 'd-flex', 'align-items-center');

                         const subcategoryCol2 = document.createElement('div');
                         subcategoryCol2.classList.add('col-md-4');

                         const subcategorySelect = document.createElement('select');
                         subcategorySelect.classList.add('form-select', 'mb-1');
                         subcategorySelect.name =
                         'additional_subcategories[]'; // Name added to additional subcategory select
                         subcategorySelect.innerHTML =
                         '<option value="">Select Subcategory</option>';

                         fetchSubcategories(selectedCategory).then(subcategories => {
                             subcategories.forEach(subcat => {
                                 const option = document.createElement('option');
                                 option.value = subcat.id;
                                 option.textContent = subcat.name;
                                 subcategorySelect.appendChild(option);
                             });
                         });

                         const removeBtn = document.createElement('button');
                         removeBtn.textContent = 'Remove';
                         removeBtn.classList.add('btn', 'btn-danger', 'mb-1');
                         removeBtn.type = 'button'; // Ensure it doesn't trigger form submission
                         removeBtn.addEventListener('click', () => {
                             subcategoryWrapper.remove();
                         });

                         subcategoryCol1.appendChild(subcategorySelect);
                         subcategoryCol2.appendChild(removeBtn);
                         subcategoryWrapper.appendChild(subcategoryCol1);
                         subcategoryWrapper.appendChild(subcategoryCol2);

                         const addMoreInputsBtn = document.createElement('button');
                         addMoreInputsBtn.textContent = 'اضافة شرح/تدريب/بث مباشر';
                         addMoreInputsBtn.classList.add('btn', 'btn-primary', 'mb-1');
                         addMoreInputsBtn.type =
                         'button'; // Ensure it doesn't trigger form submission

                         const subcategoryInputsContainer = document.createElement('div');
                         subcategoryInputsContainer.classList.add('container');

                         subcategoryWrapper.appendChild(addMoreInputsBtn);
                         subcategoryWrapper.appendChild(subcategoryInputsContainer);

                         addMoreInputsBtn.addEventListener('click', (event) => {
                             event.preventDefault(); // Prevent form submission
                             const inputWrapper = document.createElement('div');
                             inputWrapper.classList.add('row', 'mb-3');

                             const inputCol1 = document.createElement('div');
                             inputCol1.classList.add('col-md-5');

                             const input1 = document.createElement('input');
                             input1.type = 'text';
                             input1.classList.add('form-control', 'mb-1');
                             input1.name =
                             'additional_inputs[]'; // Name added to input field
                             input1.placeholder = 'Input Text';
                             inputCol1.appendChild(input1);

                             const inputCol2 = document.createElement('div');
                             inputCol2.classList.add('col-md-5');

                             const input2 = document.createElement('input');
                             input2.type = 'text';
                             input2.classList.add('form-control', 'mb-1');
                             input2.name =
                             'additional_inputs[]'; // Name added to input field
                             input2.placeholder = 'Input Text';
                             inputCol2.appendChild(input2);

                             const btnCol = document.createElement('div');
                             btnCol.classList.add('col-md-2', 'd-flex',
                             'align-items-center');

                             const removeBtn = document.createElement('button');
                             removeBtn.textContent = 'Remove';
                             removeBtn.classList.add('btn', 'btn-danger', 'mb-1');
                             removeBtn.type =
                             'button'; // Ensure it doesn't trigger form submission
                             removeBtn.addEventListener('click', () => {
                                 inputWrapper.remove();
                             });

                             btnCol.appendChild(removeBtn);
                             inputWrapper.appendChild(inputCol1);
                             inputWrapper.appendChild(inputCol2);
                             inputWrapper.appendChild(btnCol);
                             subcategoryInputsContainer.appendChild(inputWrapper);
                         });

                         dynamicInputsContainer.appendChild(subcategoryWrapper);
                     }
                 });

                 form.addEventListener('submit', async (e) => {
                     e.preventDefault();
                     const formData = new FormData(form);

                     try {
                         const response = await fetch(form.action, {
                             method: form.method,
                             headers: {
                                 'X-CSRF-TOKEN': csrfToken
                             },
                             body: formData
                         });

                         if (response.ok) {
                             console.log('Form submitted successfully');
                             // Optionally, handle successful form submission, e.g., display a success message, clear the form, etc.
                         } else {
                             console.error('Error submitting form:', response.statusText);
                             // Optionally, handle form submission error, e.g., display an error message
                         }
                     } catch (error) {
                         console.error('Error submitting form:', error);
                         // Optionally, handle form submission error, e.g., display an error message
                     }
                 });
             });
         });


         const ele = document.querySelector(".main");
         const btn = document.querySelector(".addcat");
         const x = {!! json_encode($stage) !!}

         const fetchData = async () => {
             try {
                 const res = await fetch(
                     "http://course.test/ar/dashboard/page/374993e5-be89-45db-83d9-7b10cb9e121f");
                 const data = await res.json(); // Assuming the response is JSON data
                 console.log(data[0]); // Log t
             } catch (error) {
                 console.error('Error fetching data:', error);
             }
         };
         btn.addEventListener("click", () => ele.innerHTML += `<div class="mb-1 row">
                <div class="col-md-2 form-check form-check-inline ">
                                        <select class="form-select" id="mainstages[]" name="mainstages[]"  onchange="fetchData()">
                                                ${x.map(item => `<option>${item.name}</option>`)}
                                        </select>
                                    </div>
                                </div>`)

         //  $(document).on('click', '.goToNextPage', function() {
         //      console.log('sss');
         //      $.ajaxSetup({
         //          headers: {
         //              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         //          }
         //      });

         //      $.ajax({
         //          method: 'get',
         //          url: "{{ route('page') }}",
         //          //  data: {
         //          //      'id': matchid,
         //          //  },
         //          success: function(data) {
         //              console.log(data);

         //          },
         //          error: function(data) {

         //              console.log(data);
         //          }
         //      });
         //  });
     </script>
 @endpush
