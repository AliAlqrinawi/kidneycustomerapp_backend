    <div class="modal fade" id="modal_test_ai_details" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>Urine test result</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                    fill="#000000">
                                    <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                    <rect fill="#000000" opacity="0.5"
                                        transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                        x="0" y="7" width="16" height="2" rx="1" />
                                </g>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <div class="row mx-2 mx-xl-10 my-3">
                    <p>Patient name : </p>
                    <p>Case ID : A012</p>
                    <p>Report Date : 07-10-2024</p>
                </div>
                <hr>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-xl-15" style="padding: 0px;">
                    <table class="table table-row-bordered table-row-gray-300 gy-7">
                        <thead style="text-align: center;">
                            <tr class="fw-bolder fs-6 text-gray-800">
                                <th>Urine examination</th>
                                <th>Result</th>
                                <th>Standard</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <tr>
                                <th>1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <td>Larry the Bird</td>
                                <td>Larry the Bird</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--end::Modal body-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button class="btn btn-white me-3">Print</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button class="btn btn-primary">
                        <span class="indicator-label">Send report</span>
                    </button>
                    <!--end::Button-->
                </div>
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

    <div class="modal fade" id="kt_modal_notification" tabindex="-1" aria-labelledby="notificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Please fill out the note</p>

                    <!-- User Name Input -->
                    <div class="mb-3">
                        <label for="userName" class="form-label">Send to <strong>User Name</strong></label>
                        <textarea rows="5" name="description" class="form-control form-control-solid" required id="exampleInputPassword1"
                            placeholder="Write here"></textarea>
                    </div>

                    <!-- Message Options -->
                    <div class="row text-center">
                        <!-- Message 1 -->
                        <div class="col-md-4">
                            <div class="message-box message-green" style="height: 100px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="message1"
                                        checked>
                                    <label class="form-check-label" for="message1">
                                        <strong>Message 1</strong><br>
                                        You do not need medical follow-up
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Message 2 -->
                        <div class="col-md-4">
                            <div class="message-box message-yellow" style="height: 100px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="message2">
                                    <label class="form-check-label" for="message2">
                                        <strong>Message 2</strong><br>
                                        You need medical follow-up
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Message 3 -->
                        <div class="col-md-4">
                            <div class="message-box message-red" style="height: 100px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="message3">
                                    <label class="form-check-label" for="message3">
                                        <strong>Message 3</strong><br>
                                        You need medical follow-up as soon as possible
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Button -->
                <div class="modal-footer">
                    <button class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_appointment" tabindex="-1" aria-labelledby="notificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">{{ __('dashboard.appointment') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form" method="POST" action="{{ route('panel.appointments.create.store') }}"
                    to="{{url()->current()}}"
                    url="{{url()->current()}}" class="w-100">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold mb-2">
                                    {{ __('dashboard.calendar') }}
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="date" name="date" class="form-control form-control-solid" required
                                    placeholder="" />
                                <!--end::Input-->
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold mb-2">
                                    {{ __('dashboard.time') }}
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="time" name="time" class="form-control form-control-solid"
                                    required />
                                <!--end::Input-->
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">
                                    {{ __('dashboard.note') }}
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea rows="4" name="note" class="form-control form-control-solid"></textarea>
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold form-label mb-2">
                                    {{ __('dashboard.provider') }}
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="provider_id" data-control="select2"
                                    data-placeholder="{{ __('dashboard.provider') }}" data-hide-search="true"
                                    class="form-select form-select-solid fw-bolder" required>
                                    <option value=""></option>
                                    @foreach ($providers as $providerData)
                                        <option value="{{ $providerData->id }}">{{ $providerData->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Card body-->
                        <!-- Add Button -->
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-white btn-active-light-primary me-2">
                                {{ __('dashboard.discard') }}
                            </button>
                            @include('panel.components.btn_submit', [
                                'btn_submit_text' => __('dashboard.save'),
                            ])
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
