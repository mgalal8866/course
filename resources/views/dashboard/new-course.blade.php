 @extends('layouts.dashboard.app')
 @section('content')


     <div>
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


                     <div class="step  ">
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
                     <div class="step ">
                         <button type="button" class="step-trigger">
                             <span class="bs-stepper-box">2</span>
                             <span class="bs-stepper-label">
                                 <span class="bs-stepper-title">{{ __('tran.attached') }} &
                                     {{ __('tran.setcourse') }}</span>
                                 {{-- <span class="bs-stepper-subtitle">{{ $pages[2]['subheading'] }}</span> --}}
                             </span>
                         </button>
                     </div>


                     <div class="line">
                         <i
                             class="fas fa-chevron-{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'left' : 'right' }} font-medium-2"></i>
                     </div>
                     <div class="step   active ">
                         <button type="button" class="step-trigger">
                             <span class="bs-stepper-box">4</span>
                             <span class="bs-stepper-label">
                                 <span class="bs-stepper-title">{{ __('tran.lessons') }}</span>
                                 {{-- <span class="bs-stepper-subtitle">{{ $pages[3]['subheading'] }}</span> --}}
                             </span>
                         </button>
                     </div>
                 </div>

                 <div class="bs-stepper-content">


                     <div id="address-step" class="content  active   ">
                         <div class="content-header">


                             <button id="addCategoryBtn" class="btn btn-warning sm mb-4 mt-2">اضافة مرحلة رئيسية</button>

                             <div id="mainContainer">

                             </div>
                             {{-- <small class="text-muted">{{ $pages[3]['subheading'] }}</small> --}}
                         </div>

                     </div>



                 </div>


                 <div class="modal fade" id="trainingModal" tabindex="-1" aria-labelledby="trainingModalLabel"
                     aria-hidden="true">
                     <div class="modal-dialog   modal-fullscreen    modal-dialog-scrollable modal-edit-user">
                         <div class="modal-content">
                             <div class="modal-header bg-transparent">
                                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                                     aria-label="Close"></button>
                             </div>
                             <div class="modal-body ">
                                 @livewire('new-scourse')
                             </div>
                         </div>
                     </div>
                 </div>

                 {{-- </form> --}}

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
         window.addEventListener('setquizid', event => {
             const inputName = event.detail.name;
             const inputElement = document.querySelector(`input[name="${inputName}"]`);
             inputElement.value = event.detail.quizid;
         });
     </script>
     <script>
        document.addEventListener('DOMContentLoaded', () => {
    const baseurl = '{{ url('/') }}'; // Update with your base URL
    if (localStorage.getItem("course_id") === null) {
        localStorage.setItem('course_id', '{{ $course_id ?? 0 }}');
    }
    let course_id = localStorage.getItem('course_id');

    const mainContainer = document.getElementById('mainContainer');
    const addCategoryBtn = document.getElementById('addCategoryBtn');

    // Fetch categories from API
    const fetchCategories = async () => {
        try {
            const response = await fetch(baseurl + '/ar/dashboard/ajax/getcategory?id=');
            return await response.json();
        } catch (error) {
            console.error('Error fetching categories:', error);
            return [];
        }
    };

    // Fetch subcategories from API based on selected category
    const fetchSubcategories = async (categoryId) => {
        try {
            const response = await fetch(baseurl + '/ar/dashboard/ajax/getcategory?id=' + categoryId);
            return await response.json();
        } catch (error) {
            console.error('Error fetching subcategories:', error);
            return [];
        }
    };

    // Populate categories in the dropdown
    const populateCategories = async (categorySelect) => {
        const categories = await fetchCategories();
        categorySelect.innerHTML = `<option value="">Select Category</option>`;
        categories.forEach(category => {
            const option = document.createElement('option');
            option.value = category.id;
            option.textContent = category.name;
            categorySelect.appendChild(option);
        });
    };

    // Function to handle validation errors
    const handleValidationErrors = (errors) => {
        Object.keys(errors).forEach((key) => {
            console.log(key);
            const input = document.querySelector(`[name="${key}"]`);
            if (input) {
                const errorMessage = document.createElement('div');
                errorMessage.classList.add('text-danger', 'mt-1');
                errorMessage.textContent = errors[key][0];
                input.insertAdjacentElement('afterend', errorMessage);
            }
        });
    };

    // Clear previous validation errors
    const clearValidationErrors = () => {
        const errorMessages = document.querySelectorAll('.text-danger');
        errorMessages.forEach((message) => message.remove());
    };

    // Create the main form element
    const form = document.createElement('form');
    form.action = baseurl + '/ar/dashboard/formsub';
    form.method = 'POST';

    // Add CSRF token input
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = csrfToken;
    form.appendChild(csrfInput);

    const inputcourse_id = document.createElement('input');
    inputcourse_id.type = 'hidden';
    inputcourse_id.name = 'inputcourse_id';
    inputcourse_id.value = course_id;
    form.appendChild(inputcourse_id);

    // Container for dynamic inputs
    const dynamicInputsContainer = document.createElement('div');
    dynamicInputsContainer.classList.add('container');
    form.appendChild(dynamicInputsContainer);
    mainContainer.appendChild(form);

    const submitBtn = document.createElement('button');
    submitBtn.textContent = 'Submit';
    submitBtn.classList.add('btn', 'btn-primary', 'mt-3');
    submitBtn.type = 'submit';
    form.appendChild(submitBtn);

    // Event listener to add category and subcategory inputs
    addCategoryBtn.addEventListener('click', () => {
        const categoryIndex = dynamicInputsContainer.children.length;

        const categoryContainer = document.createElement('div');
        categoryContainer.classList.add('container', 'mb-3', 'p-3', 'border', 'border-primary', 'rounded');

        const categoryRow = document.createElement('div');
        categoryRow.classList.add('row', 'mb-1');

        const col = document.createElement('div');
        col.classList.add('col-md-6');

        const categorySelect = document.createElement('select');
        categorySelect.classList.add('form-select', 'mb-1');
        categorySelect.name = `categories[${categoryIndex}][category_id]`;
        categorySelect.required = true;
        col.appendChild(categorySelect);
        categoryRow.appendChild(col);

        const col2 = document.createElement('div');
        col2.classList.add('col-md-1');

        const removeCategoryBtn = document.createElement('button');
        removeCategoryBtn.textContent = 'حذف المرحلة الرئيسية';
        removeCategoryBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'mb-1');
        removeCategoryBtn.type = 'button';
        removeCategoryBtn.addEventListener('click', () => {
            categoryContainer.remove();
        });
        col2.appendChild(removeCategoryBtn);
        categoryRow.appendChild(col2);

        const subcategoryContainer = document.createElement('div');
        subcategoryContainer.classList.add('container', 'mb-3');

        const addSubcategoryBtn = document.createElement('button');
        addSubcategoryBtn.textContent = 'اضافة قسم فرعى';
        addSubcategoryBtn.classList.add('btn', 'btn-secondary', 'mb-1');
        addSubcategoryBtn.type = 'button';

        subcategoryContainer.appendChild(addSubcategoryBtn);
        categoryContainer.appendChild(categoryRow);
        categoryContainer.appendChild(subcategoryContainer);
        dynamicInputsContainer.appendChild(categoryContainer);

        // Populate categories when the category select is added
        populateCategories(categorySelect);

        addSubcategoryBtn.addEventListener('click', () => {
            const subcategoryIndex = subcategoryContainer.children.length - 1; // Excluding the add button

            const subcategoryWrapper = document.createElement('div');
            subcategoryWrapper.classList.add('row', 'mb-1');

            const subcategoryCol1 = document.createElement('div');
            subcategoryCol1.classList.add('col-md-4', 'd-flex', 'align-items-center');

            const subcategoryCol2 = document.createElement('div');
            subcategoryCol2.classList.add('col-md-1');

            const subcategorySelect = document.createElement('select');
            subcategorySelect.required = true;
            subcategorySelect.classList.add('form-select', 'mb-1');
            subcategorySelect.name = `categories[${categoryIndex}][subcategories][${subcategoryIndex}][subcategory_id]`;

            subcategoryCol1.appendChild(subcategorySelect);

            const removeSubcategoryBtn = document.createElement('button');
            removeSubcategoryBtn.textContent = 'حذف القسم الفرعى';
            removeSubcategoryBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'mb-1');
            removeSubcategoryBtn.type = 'button';
            removeSubcategoryBtn.addEventListener('click', () => {
                subcategoryWrapper.remove();
            });
            subcategoryCol2.appendChild(removeSubcategoryBtn);

            const subcategoryInputsContainer = document.createElement('div');
            subcategoryInputsContainer.classList.add('container');

            fetchSubcategories(categorySelect.value).then(subcategories => {
                subcategories.forEach(subcat => {
                    const option = document.createElement('option');
                    option.value = subcat.id;
                    option.textContent = subcat.name;
                    subcategorySelect.appendChild(option);
                });
            });
            categorySelect.addEventListener('change', async () => {
                const selectedCategory = categorySelect.value;
                subcategorySelect.innerHTML = `<option value="">Select Subcategory</option>`;

                subcategorySelect.name = `categories[${categoryIndex}][subcategories][${subcategoryIndex}][subcategory_id]`;
                if (selectedCategory) {
                    const subcategories = await fetchSubcategories(selectedCategory);
                    subcategories.forEach(subcat => {
                        const option = document.createElement('option');
                        option.value = subcat.id;
                        option.textContent = subcat.name;
                        subcategorySelect.appendChild(option);
                    });
                }
            });
            subcategoryWrapper.appendChild(subcategoryCol1);
            subcategoryWrapper.appendChild(subcategoryCol2);
            subcategoryWrapper.appendChild(subcategoryInputsContainer);

            const addMoreInputsBtn = document.createElement('button');
            addMoreInputsBtn.textContent = 'اضافة شرح/تدريب/بث مباشر';
            addMoreInputsBtn.classList.add('btn', 'btn-primary', 'mb-1');
            addMoreInputsBtn.type = 'button';

            subcategoryWrapper.appendChild(addMoreInputsBtn);
            subcategoryContainer.insertBefore(subcategoryWrapper, addSubcategoryBtn);

            addMoreInputsBtn.addEventListener('click', () => {
                const inputIndex = subcategoryInputsContainer.children.length;

                const inputWrapper = document.createElement('div');
                inputWrapper.classList.add('row', 'mb-3');

                const inputCol0 = document.createElement('div');
                inputCol0.classList.add('col-md-2');

                const input0Container = document.createElement('div');
                const input0 = document.createElement('select');
                input0.classList.add('form-select', 'mb-1');
                input0.name = `categories[${categoryIndex}][subcategories][${subcategoryIndex}][inputs][${inputIndex}][type]`;
                input0.innerHTML = '<option value="1" selected>شرح</option>' + '<option value="2">بث مباشر</option>' + '<option value="0">تدريب</option>';
                input0.required = true;
                input0Container.appendChild(input0);
                inputCol0.appendChild(input0Container);

                const inputDateCol = document.createElement('div');
                inputDateCol.classList.add('col-md-2');

                const inputDateContainer = document.createElement('div');
                const inputDate = document.createElement('input');
                inputDate.type = 'date';
                inputDate.classList.add('form-control', 'mb-1');
                inputDate.name = `categories[${categoryIndex}][subcategories][${subcategoryIndex}][inputs][${inputIndex}][date]`;
                inputDateContainer.appendChild(inputDate);
                inputDateCol.appendChild(inputDateContainer);

                const inputCol1 = document.createElement('div');
                inputCol1.classList.add('col-md-3');

                const input1Container = document.createElement('div');
                const input1 = document.createElement('input');
                input1.type = 'text';
                input1.classList.add('form-control', 'mb-1');
                input1.name = `categories[${categoryIndex}][subcategories][${subcategoryIndex}][inputs][${inputIndex}][name]`;
                input1.placeholder = 'اسم الشرح';
                input1.required = true;
                input1Container.appendChild(input1);
                inputCol1.appendChild(input1Container);

                const inputCol2 = document.createElement('div');
                inputCol2.classList.add('col-md-3');

                const input2Container = document.createElement('div');
                const input2 = document.createElement('input');
                input2.type = 'text';
                input2.classList.add('form-control', 'mb-1');
                input2.name = `categories[${categoryIndex}][subcategories][${subcategoryIndex}][inputs][${inputIndex}][link]`;
                input2.placeholder = 'رابط الشرح';
                input2.required = true;
                input2Container.appendChild(input2);
                inputCol2.appendChild(input2Container);

                const btnCol = document.createElement('div');
                btnCol.classList.add('col-md-1', 'd-flex', 'align-items-center');

                const removeBtn = document.createElement('button');
                removeBtn.textContent = 'Remove';
                removeBtn.classList.add('btn', 'btn-danger', 'mb-1');
                removeBtn.type = 'button'; // Ensure it doesn't trigger form submission
                removeBtn.addEventListener('click', () => {
                    inputWrapper.remove();
                });

                btnCol.appendChild(removeBtn);
                inputWrapper.appendChild(inputCol0);
                inputWrapper.appendChild(inputCol1);
                inputWrapper.appendChild(inputCol2);
                inputWrapper.appendChild(inputDateCol);
                inputWrapper.appendChild(btnCol);
                subcategoryInputsContainer.appendChild(inputWrapper);
            });
        });
    });

    form.addEventListener('submit', async (event) => {
        event.preventDefault(); // Prevent default form submission

        clearValidationErrors(); // Clear previous validation errors

        const formData = new FormData(form);
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            if (!response.ok) {
                const data = await response.json();
                if (data.errors) {
                    handleValidationErrors(data.errors);
                }
            } else {
                // Handle successful form submission (optional)
                console.log('Form submitted successfully');
            }
        } catch (error) {
            console.error('Error submitting form:', error);
        }
    });
});

     </script>
 @endpush
