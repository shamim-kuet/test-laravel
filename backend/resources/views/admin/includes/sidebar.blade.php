<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    @if (\Utility::checkPermission('product.create') ||
        \Utility::checkPermission('product.index') ||
        \Utility::checkPermission('order.create') ||
        \Utility::checkPermission('order.create') ||
        \Utility::checkPermission('pickup.create') ||
        \Utility::checkPermission('pickup.index') ||
        \Utility::checkPermission('role.create') ||
        \Utility::checkPermission('role.index'))

        <li class="navigation-header text-truncate"><span>Operation</span></li>
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Pickup Manage</span></a>
            <ul class="menu-content">
                @if (\Utility::checkPermission('product.create') || \Utility::checkPermission('product.index'))
                    <li>
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">Product</span></a>
                        <ul class="menu-content">
                            @if (\Utility::checkPermission('product.create'))
                                <li class="{{ Route::currentRouteName() === 'product.create' ? 'active' : '' }}">
                                    <a class="d-flex align-items-center" href="{{ route('product.create') }}">
                                        <i data-feather="plus"></i><span class="menu-order text-truncate"
                                            data-i18n="List">New
                                            Product</span></a>
                                </li>
                            @endif
                            @if (\Utility::checkPermission('product.index'))
                                <li class="{{ Route::currentRouteName() === 'product.index' ? 'active' : '' }}"><a
                                        class="d-flex align-items-center" href="{{ route('product.index') }}">
                                        <i data-feather="list"></i><span class="menu-item text-truncate"
                                            data-i18n="List">Product
                                            List</span></a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (\Utility::checkPermission('order.create') || \Utility::checkPermission('order.create'))
                    <li>
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">Order</span>
                        </a>
                        <ul class="menu-content">
                            @if (\Utility::checkPermission('order.create'))
                                <li class="{{ Route::currentRouteName() === 'order.create' ? 'active' : '' }}"><a
                                        class="d-flex align-items-center" href="{{ route('order.create') }}">
                                        <i data-feather="plus"></i><span class="menu-order text-truncate"
                                            data-i18n="List">New
                                            Order</span></a>
                                </li>
                            @endif
                            @if (\Utility::checkPermission('order.index'))
                                <li class="{{ Route::currentRouteName() === 'order.index' ? 'active' : '' }}">
                                    <a class="d-flex align-items-center" href="{{ route('order.index') }}">
                                        <i data-feather="list"></i><span class="menu-item text-truncate"
                                            data-i18n="List">Order
                                            List</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (\Utility::checkPermission('pickup.create') || \Utility::checkPermission('pickup.index'))
                    <li>
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">Assign
                                Pickup</span></a>
                        <ul class="menu-content">
                            @if (\Utility::checkPermission('pickup.create'))
                                <li class="{{ Route::currentRouteName() === 'pickup.create' ? 'active' : '' }}">
                                    <a class="d-flex align-items-center" href="{{ route('pickup.create') }}">
                                        <i data-feather="plus"></i><span class="menu-item text-truncate"
                                            data-i18n="List">New
                                            Asssign</span></a>
                                </li>
                            @endif
                            @if (\Utility::checkPermission('pickup.index'))
                                <li class="{{ Route::currentRouteName() === 'pickup.index' ? 'active' : '' }}">
                                    <a class="d-flex align-items-center" href="{{ route('pickup.index') }}">
                                        <i data-feather="list"></i><span class="menu-item text-truncate"
                                            data-i18n="List">Asssigned
                                            List</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

            </ul>
        </li>
    @endif



    @if (\Utility::checkPermission('delivery.create') ||
        \Utility::checkPermission('delivery.index') ||
        \Utility::checkPermission('role.create') ||
        \Utility::checkPermission('role.index') ||
        \Utility::checkPermission('deliveryhub.create'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Delivery Manage</span></a>
            <ul class="menu-content">
                @if (\Utility::checkPermission('delivery.create') || \Utility::checkPermission('delivery.index'))
                    <li>
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">Assign
                                Delivery</span></a>
                        <ul class="menu-content">
                            @if (\Utility::checkPermission('delivery.create'))
                                <li class="{{ Route::currentRouteName() === 'delivery.create' ? 'active' : '' }}"><a
                                        class="d-flex align-items-center" href="{{ route('delivery.create') }}">
                                        <i data-feather="plus"></i><span class="menu-item text-truncate"
                                            data-i18n="List">New
                                            Asssign</span>
                                    </a>
                                </li>
                            @endif
                            @if (\Utility::checkPermission('delivery.index'))
                                <li class="{{ Route::currentRouteName() === 'delivery.index' ? 'active' : '' }}"><a
                                        class="d-flex align-items-center" href="{{ route('delivery.index') }}">
                                        <i data-feather="list"></i><span class="menu-item text-truncate"
                                            data-i18n="List">Asssigned
                                            List</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (\Utility::checkPermission('deliveryhub.create'))
                    <li>
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">Assign
                                Delivery Hub</span></a>
                        <ul class="menu-content">
                            @if (\Utility::checkPermission('deliveryhub.create'))
                                <li class="{{ Route::currentRouteName() === 'deliveryhub.create' ? 'active' : '' }}"><a
                                        class="d-flex align-items-center" href="{{ route('deliveryhub.create') }}">
                                        <i data-feather="plus"></i><span class="menu-item text-truncate"
                                            data-i18n="List">New Hub
                                            Asssign</span>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif
                <li class="{{ Route::currentRouteName() === 'deliveryCashRecivedList' ? 'active' : '' }}"><a
                        class="d-flex align-items-center" href="{{ route('deliveryCashRecivedList') }}">
                        <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">Cash
                            Recived List</span></a>
                </li>
                @if (\Utility::checkPermission('delivery.reschedule'))
                    <li class="{{ Route::currentRouteName() === 'delivery.reschedule' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('delivery.reschedule') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">Reschedule</span></a>
                    </li>
                @endif
            </ul>
        </li>
    @endif



    @if (\Utility::checkPermission('cashhandover.index') || \Utility::checkPermission('invoicegenerate.index'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Billing</span></a>
            <ul class="menu-content">

                @if (\Utility::checkPermission('cashhandover.index'))
                    <li class="{{ Route::currentRouteName() === 'cashhandover.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('cashhandover.index') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">Cash
                                Handover</span></a>
                    </li>
                @endif

                @if (\Utility::checkPermission('invoicegenerate.index'))
                    <li class="{{ Route::currentRouteName() === 'invoicegenerate.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('invoicegenerate.index') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">Invoice
                                Generate</span></a>
                    </li>
                @endif
                @if (\Utility::checkPermission('invoicegenerate.list'))
                    <li class="{{ Route::currentRouteName() === 'invoicegenerate.list' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('invoicegenerate.list') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">
                                Generated
                                Invoice</span></a>
                    </li>
                @endif
            </ul>
        </li>
    @endif


    @if (\Utility::checkPermission('paymentrequest.index') || \Utility::checkPermission('merchantpayment.index'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Merchant Payment</span></a>
            <ul class="menu-content">

                @if (\Utility::checkPermission('merchantpayment.index'))
                    <li class="{{ Route::currentRouteName() === 'merchantpayment.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('merchantpayment.index') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">Merchant
                                Payment List</span></a>
                    </li>
                @endif
                @if (\Utility::checkPermission('paymentrequest.index'))
                    <li class="{{ Route::currentRouteName() === 'paymentrequest.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('paymentrequest.index') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">Payment
                                Request List</span></a>
                    </li>
                @endif
            </ul>
        </li>
    @endif


    <li class="navigation-header text-truncate"><span>Content Manage</span></li>

    @if (\Utility::checkPermission('user.create') || \Utility::checkPermission('user.index'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='users'></i><span
                    class="menu-title text-truncate" data-i18n="Board">User</span></a>
            <ul class="menu-content">
                @if (\Utility::checkPermission('user.create'))
                    <li class="{{ Route::currentRouteName() === 'user.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('user.create') }}"><i
                                data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">New</span></a>
                    </li>
                @endif
                @if (\Utility::checkPermission('user.index'))
                    <li class="{{ Route::currentRouteName() === 'user.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('user.index') }}"><i
                                data-feather="list"></i><span class="menu-item text-truncate"
                                data-i18n="List">View</span></a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
    @if (\Utility::checkPermission('group.create') || \Utility::checkPermission('group.index'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Role Group</span></a>
            <ul class="menu-content">
                @if (\Utility::checkPermission('group.create'))
                    <li class="{{ Route::currentRouteName() === 'group.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('group.create') }}"><i
                                data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">New</span></a>
                    </li>
                @endif
                @if (\Utility::checkPermission('group.index'))
                    <li class="{{ Route::currentRouteName() === 'group.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('group.index') }}"><i
                                data-feather="list"></i><span class="menu-item text-truncate"
                                data-i18n="List">View</span></a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
    @if (\Utility::checkPermission('role.create') || \Utility::checkPermission('role.index'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Role</span></a>
            <ul class="menu-content">
                @if (\Utility::checkPermission('role.create'))
                    <li class="{{ Route::currentRouteName() === 'role.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('role.create') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">New</span></a>
                    </li>
                @endif
                @if (\Utility::checkPermission('role.index'))
                    <li class="{{ Route::currentRouteName() === 'role.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('role.index') }}">
                            <i data-feather="list"></i><span class="menu-item text-truncate"
                                data-i18n="List">View</span></a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
    @if (\Utility::checkPermission('permission.create') || \Utility::checkPermission('permission.index'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Permission</span></a>
            <ul class="menu-content">
                @if (\Utility::checkPermission('permission.create'))
                    <li class="{{ Route::currentRouteName() === 'permission.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('permission.create') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">New</span></a>
                    </li>
                @endif
                @if (\Utility::checkPermission('permission.index'))
                    <li class="{{ Route::currentRouteName() === 'permission.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('permission.index') }}">
                            <i data-feather="list"></i><span class="menu-item text-truncate"
                                data-i18n="List">View</span></a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
    @if (\Utility::checkPermission('permission.index'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Role Permission</span></a>
            <ul class="menu-content">

                <li class="{{ Route::currentRouteName() === 'role-permission.index' ? 'active' : '' }}"><a
                        class="d-flex align-items-center" href="{{ route('role-permission.index') }}">
                        <i data-feather="list"></i><span class="menu-item text-truncate"
                            data-i18n="List">View</span></a>
                </li>

            </ul>
        </li>
    @endif

    @if (\Utility::checkPermission('plan.create') || \Utility::checkPermission('plan.index'))


        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='compass'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Plan</span></a>
            <ul class="menu-content">
                @if (\Utility::checkPermission('plan.create'))
                    <li class="{{ Route::currentRouteName() === 'plan.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('plan.create') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New
                                Plan</span></a></li>
                @endif
                @if (\Utility::checkPermission('plan.index'))
                    <li class="{{ Route::currentRouteName() === 'plan.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('plan.index') }}">
                            <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">Plan
                                List</span></a></li>
                @endif
            </ul>
        </li>
    @endif


    @if (\Utility::checkPermission('merchant.create'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='compass'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Merchant</span></a>
            <ul class="menu-content">
                @if (\Utility::checkPermission('merchant.create') || \Utility::checkPermission('merchant.index'))
                    <li class="{{ Route::currentRouteName() === 'merchant.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('merchant.create') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">New</span></a>
                    </li>
                @endif
                @if (\Utility::checkPermission('merchant.index'))
                    <li class="{{ Route::currentRouteName() === 'merchant.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('merchant.index') }}">
                            <i data-feather="list"></i><span class="menu-item text-truncate"
                                data-i18n="List">View</span></a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
    {{-- @if (\Utility::checkPermission('partner.create') || \Utility::checkPermission('partner.index'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='compass'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Partner</span></a>
            <ul class="menu-content">
                @if (\Utility::checkPermission('partner.create'))
                    <li class="{{ Route::currentRouteName() === 'partner.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('partner.create') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">New</span></a>
                    </li>
                @endif
                @if (\Utility::checkPermission('partner.index'))
                    <li class="{{ Route::currentRouteName() === 'partner.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('partner.index') }}">
                            <i data-feather="list"></i><span class="menu-item text-truncate"
                                data-i18n="List">View</span></a>
                    </li>
                @endif
            </ul>
        </li>
    @endif --}}
    @if (\Utility::checkPermission('rider.create') || \Utility::checkPermission('rider.index'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='users'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Rider</span></a>
            <ul class="menu-content">
                @if (\Utility::checkPermission('rider.create'))
                    <li class="{{ Route::currentRouteName() === 'rider.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('rider.create') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">New</span></a>
                    </li>
                @endif
                @if (\Utility::checkPermission('rider.index'))
                    <li class="{{ Route::currentRouteName() === 'rider.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('rider.index') }}">
                            <i data-feather="list"></i><span class="menu-item text-truncate"
                                data-i18n="List">View</span></a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
    @if (\Utility::checkPermission('store.create') || \Utility::checkPermission('store.index'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Store Manage</span></a>
            <ul class="menu-content">
                @if (\Utility::checkPermission('store.create'))
                    <li class="{{ Route::currentRouteName() === 'store.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('store.create') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">New</span></a>
                    </li>
                @endif
                @if (\Utility::checkPermission('store.index'))
                    <li class="{{ Route::currentRouteName() === 'store.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('store.index') }}">
                            <i data-feather="list"></i><span class="menu-item text-truncate"
                                data-i18n="List">View</span>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
    {{-- @if (\Utility::checkPermission('hublocation.create') || \Utility::checkPermission('hublocation.index'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Hub Location</span></a>
            <ul class="menu-content">
                @if (\Utility::checkPermission('hublocation.create'))
                    <li class="{{ Route::currentRouteName() === 'hublocation.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('hublocation.create') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">New</span></a>
                    </li>
                @endif
                @if (\Utility::checkPermission('hublocation.index'))
                    <li class="{{ Route::currentRouteName() === 'hublocation.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('hublocation.index') }}">
                            <i data-feather="list"></i><span class="menu-item text-truncate"
                                data-i18n="List">View</span></a>
                    </li>
                @endif
            </ul>
        </li>
    @endif --}}
    @if (\Utility::checkPermission('hub.create') || \Utility::checkPermission('hub.index'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Hub Manage</span></a>
            <ul class="menu-content">
                @if (\Utility::checkPermission('hub.create'))
                    <li class="{{ Route::currentRouteName() === 'hub.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('hub.create') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">New</span></a>
                    </li>
                @endif
                @if (\Utility::checkPermission('hub.index'))
                    <li class="{{ Route::currentRouteName() === 'hub.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('hub.index') }}">
                            <i data-feather="list"></i><span class="menu-item text-truncate"
                                data-i18n="List">View</span></a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
    @if (\Utility::checkPermission('banner.create') || \Utility::checkPermission('banner.index'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='image'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Banner</span></a>
            <ul class="menu-content">
                @if (\Utility::checkPermission('banner.create'))
                    <li class="{{ Route::currentRouteName() === 'banner.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('banner.create') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">New</span></a>
                    </li>
                @endif
                @if (\Utility::checkPermission('banner.index'))
                    <li class="{{ Route::currentRouteName() === 'banner.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('banner.index') }}">
                            <i data-feather="list"></i><span class="menu-item text-truncate"
                                data-i18n="List">View</span></a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
    @if (\Utility::checkPermission('complaint.create'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='image'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Manage Complaints</span></a>
            <ul class="menu-content">
                @if (\Utility::checkPermission('complaint.create'))
                    <li class="{{ Route::currentRouteName() === 'complaint.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('complaint.create') }}"><i
                                data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">New</span></a>
                    </li>
                @endif
                @if (\Utility::checkPermission('complaint.index'))
                    <li class="{{ Route::currentRouteName() === 'complaint.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('complaint.index') }}"><i
                                data-feather="list"></i><span class="menu-item text-truncate"
                                data-i18n="List">View</span></a>
                    </li>
                @endif
            </ul>
        </li>
    @endif


    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='image'></i><span
                class="menu-title text-truncate" data-i18n="Board">Manage Area</span></a>
        <ul class="menu-content">

            <li class="{{ Route::currentRouteName() === 'district.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('district.index') }}"><i
                        data-feather="list"></i><span class="menu-item text-truncate"
                        data-i18n="List">District</span></a>
            </li>
            <li class="{{ Route::currentRouteName() === 'upazilla.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('upazilla.index') }}"><i
                        data-feather="list"></i><span class="menu-item text-truncate"
                        data-i18n="List">Upazilla</span></a>
            </li>
        </ul>
    </li>





    <li class="navigation-header text-truncate"><span>Reports</span></li>
    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='twitch'></i><span
                class="menu-title text-truncate" data-i18n="Board">Reports</span></a>
    </li>
    @if (\Utility::checkPermission('merchantpaymentreport'))
        <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('merchantpaymentreport') }}"><i
                    data-feather='twitch'></i><span class="menu-title text-truncate" data-i18n="Board">Merchant
                    Payment Report</span></a>
        </li>
    @endif
    <li class="nav-item"><a class="d-flex align-items-center"
        href="{{ route('rider_report') }}"><i data-feather='twitch'></i><span
            class="menu-title text-truncate" data-i18n="Board">Rider Report</span></a>
    </li>
    @if (\Utility::checkPermission('user.create') ||
        \Utility::checkPermission('user.index') ||
        \Utility::checkPermission('user.create') ||
        \Utility::checkPermission('user.index') ||
        \Utility::checkPermission('user.create') ||
        \Utility::checkPermission('user.index'))
        <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='file'></i><span
                    class="menu-title text-truncate" data-i18n="Board">Document</span></a>
            <ul class="menu-content">
                @if (\Utility::checkPermission('user.create') || \Utility::checkPermission('user.index'))
                    <li class="{{ Route::currentRouteName() === 'user.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('user.create') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">User
                                Document</span></a>
                        <ul class="menu-content">
                            @if (\Utility::checkPermission('user.create'))
                                <li class="{{ Route::currentRouteName() === 'user.create' ? 'active' : '' }}"><a
                                        class="d-flex align-items-center" href="{{ route('user.create') }}">
                                        <i data-feather="plus"></i><span class="menu-item text-truncate"
                                            data-i18n="List">New</span></a></li>
                            @endif
                            @if (\Utility::checkPermission('user.index'))
                                <li class="{{ Route::currentRouteName() === 'user.index' ? 'active' : '' }}"><a
                                        class="d-flex align-items-center" href="{{ route('user.index') }}">
                                        <i data-feather="list"></i><span class="menu-item text-truncate"
                                            data-i18n="List">View</span></a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if (\Utility::checkPermission('user.create') || \Utility::checkPermission('user.index'))
                    <li class="{{ Route::currentRouteName() === 'user.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('user.create') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">Rider
                                Document</span></a>
                        <ul class="menu-content">
                            @if (\Utility::checkPermission('user.create'))
                                <li class="{{ Route::currentRouteName() === 'user.create' ? 'active' : '' }}"><a
                                        class="d-flex align-items-center" href="{{ route('user.create') }}">
                                        <i data-feather="plus"></i><span class="menu-item text-truncate"
                                            data-i18n="List">New</span></a></li>
                            @endif
                            @if (\Utility::checkPermission('user.index'))
                                <li class="{{ Route::currentRouteName() === 'user.index' ? 'active' : '' }}"><a
                                        class="d-flex align-items-center" href="{{ route('user.index') }}">
                                        <i data-feather="list"></i><span class="menu-item text-truncate"
                                            data-i18n="List">View</span></a></li>
                            @endif

                        </ul>
                    </li>
                @endif
                @if (\Utility::checkPermission('user.create') || \Utility::checkPermission('user.index'))
                    <li class="{{ Route::currentRouteName() === 'user.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('user.create') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate"
                                data-i18n="List">Merchant
                                Document</span></a>
                        <ul class="menu-content">
                            @if (\Utility::checkPermission('user.create'))
                                <li class="{{ Route::currentRouteName() === 'user.create' ? 'active' : '' }}"><a
                                        class="d-flex align-items-center" href="{{ route('user.create') }}">
                                        <i data-feather="plus"></i><span class="menu-item text-truncate"
                                            data-i18n="List">New</span></a></li>
                            @endif
                            @if (\Utility::checkPermission('user.index'))
                                <li class="{{ Route::currentRouteName() === 'user.index' ? 'active' : '' }}"><a
                                        class="d-flex align-items-center" href="{{ route('user.index') }}">
                                        <i data-feather="list"></i><span class="menu-item text-truncate"
                                            data-i18n="List">View</span></a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
        </li>
    @endif
    @if (\Utility::checkPermission('setting.create') ||
        \Utility::checkPermission('user_type.index') ||
        \Utility::checkPermission('vehicle_type.index') ||
        \Utility::checkPermission('delivery_status.index') ||
        \Utility::checkPermission('user_type.create') ||
        \Utility::checkPermission('user_type.index'))
        <li class="navigation-header text-truncate"><span>Settings</span></li>
        <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i
                    data-feather="settings"></i><span class="menu-title text-truncate"
                    data-i18n="Board">Settings</span></a>
            <ul class="menu-content">

                <li class="{{ Route::currentRouteName() === 'documenttype.index' ? 'active' : '' }}"><a
                        class="d-flex align-items-center" href="{{ route('documenttype.index') }}">
                        <span class="menu-item text-truncate" data-i18n="Third Level">
                            <i data-feather="circle"></i>Document Type</span></a>
                </li>

                <li class="{{ Route::currentRouteName() === 'deliverystatus.index' ? 'active' : '' }}"><a
                        class="d-flex align-items-center" href="{{ route('deliverystatus.index') }}">
                        <span class="menu-item text-truncate" data-i18n="Third Level">
                            <i data-feather="circle"></i>Delivery Status</span></a>
                </li>

                <li class="{{ Route::currentRouteName() === 'paymentstatus.index' ? 'active' : '' }}"><a
                        class="d-flex align-items-center" href="{{ route('paymentstatus.index') }}">
                        <span class="menu-item text-truncate" data-i18n="Third Level">
                            <i data-feather="circle"></i>Payment Status</span></a>
                </li>

                <li class="{{ Route::currentRouteName() === 'generalsetting.index' ? 'active' : '' }}"><a
                        class="d-flex align-items-center" href="{{ route('generalsetting.index') }}">
                        <span class="menu-item text-truncate" data-i18n="Third Level">
                            <i data-feather="circle"></i>General Setting</span></a>
                </li>

                {{-- <li class="{{ Route::currentRouteName() === 'vehicletype.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('vehicletype.index') }}">
                    <span class="menu-item text-truncate" data-i18n="Third Level">
                        <i data-feather="circle"></i>Vehicle Type</span></a>
            </li> --}}

                <li class="{{ Route::currentRouteName() === 'subscriptiontype.index' ? 'active' : '' }}"><a
                        class="d-flex align-items-center" href="{{ route('subscriptiontype.index') }}">
                        <span class="menu-item text-truncate" data-i18n="Third Level">
                            <i data-feather="circle"></i>Subscription Type</span></a>
                </li>

                <li class="{{ Route::currentRouteName() === 'employeeid.index' ? 'active' : '' }}"><a
                        class="d-flex align-items-center" href="{{ route('employeeid.index') }}">
                        <span class="menu-item text-truncate" data-i18n="Third Level">
                            <i data-feather="circle"></i>Employee ID</span></a>
                </li>

                <li class="{{ Route::currentRouteName() === 'deliverynote.index' ? 'active' : '' }}"><a
                        class="d-flex align-items-center" href="{{ route('deliverynote.index') }}">
                        <span class="menu-item text-truncate" data-i18n="Third Level">
                            <i data-feather="circle"></i>Delivery/Pickup Note</span></a>
                </li>
                <li class="{{ Route::currentRouteName() === 'codcharge.index' ? 'active' : '' }}"><a
                        class="d-flex align-items-center" href="{{ route('codcharge.index') }}">
                        <span class="menu-item text-truncate" data-i18n="Third Level">
                            <i data-feather="circle"></i>COD Charge</span></a>
                </li>


        </li>
    @endif
</ul>
