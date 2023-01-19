<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

    <li class="navigation-header text-truncate"><span>Operation</span></li>
    <li>
        <a class="d-flex align-items-center" href="#">
            <i data-feather="box"></i><span class="menu-item text-truncate" data-i18n="List">Product</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'product.create' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('product.create') }}">
                    <i data-feather="plus"></i><span class="menu-order text-truncate" data-i18n="List">New
                        Product</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'product.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('product.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">Product
                        List</span></a>
            </li>

        </ul>
    </li>

    <li>
        <a class="d-flex align-items-center" href="#">
            <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">Order <button
                    class="btn-sm btn-danger"
                    style="padding: 2px;">{{ $homeNotify ? $homeNotify->torder : '' }}</button></span>
        </a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'order.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('order.create') }}">
                    <i data-feather="plus"></i><span class="menu-order text-truncate" data-i18n="List">New
                        Order</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'order.index' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('order.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">Order
                        List</span>
                </a>
            </li>

        </ul>
    </li>

    <li>
        <a class="d-flex align-items-center" href="#">
            <i data-feather="box"></i><span class="menu-item text-truncate" data-i18n="List">PO Manage</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'pickup.create' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('pickup.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New PO</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'pickup.index' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('pickup.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">Generated PO</span>
                </a>
            </li>

        </ul>
    </li>



    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                class="menu-title text-truncate" data-i18n="Board">Delivery Manage</span></a>
        <ul class="menu-content">

            <li>
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">Assign
                        Delivery Hub</span></a>
                <ul class="menu-content">
                    <li class="{{ Route::currentRouteName() === 'deliveryhub.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('deliveryhub.create') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New Hub
                                Assign</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="{{ Route::currentRouteName() === 'hubAssignedList' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('hubAssignedList') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">Hub
                        Assigned List</span></a>
            </li>
            <li>
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">Assign
                        Delivery</span></a>
                <ul class="menu-content">
                    <li class="{{ Route::currentRouteName() === 'delivery.create' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('delivery.create') }}">
                            <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New
                                Asssign</span>
                        </a>
                    </li>

                    <li class="{{ Route::currentRouteName() === 'delivery.index' ? 'active' : '' }}"><a
                            class="d-flex align-items-center" href="{{ route('delivery.index') }}">
                            <i data-feather="list"></i><span class="menu-item text-truncate"
                                data-i18n="List">Asssigned
                                List</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="{{ Route::currentRouteName() === 'deliveryCashRecivedList' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('deliveryCashRecivedList') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">Cash Recived
                        List</span></a>
            </li>


            <li class="{{ Route::currentRouteName() === 'delivery.reschedule' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('delivery.reschedule') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate"
                        data-i18n="List">Reschedule</span></a>
            </li>

        </ul>


    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='credit-card'></i><span
                class="menu-title text-truncate" data-i18n="Board">Billing</span></a>
        <ul class="menu-content">

            <li class="{{ Route::currentRouteName() === 'invoicegenerate.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('invoicegenerate.index') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">Invoice
                        Generate</span></a>
            </li>
            <li class="{{ Route::currentRouteName() === 'invoicegenerate.list' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('invoicegenerate.list') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List"> Generated
                        Invoice</span></a>
            </li>
        </ul>
    </li>




    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                class="menu-title text-truncate" data-i18n="Board">Merchant Payment</span></a>
        <ul class="menu-content">


            <li class="{{ Route::currentRouteName() === 'merchantpayment.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('merchantpayment.index') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">Merchant
                        Payment
                        List</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'paymentrequest.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('paymentrequest.index') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">Payment Request
                        List</span></a>
            </li>
        </ul>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='mail'></i><span
                class="menu-title text-truncate" data-i18n="Board">Support/Ticketing System</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'banner.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'banner.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="navigation-header text-truncate"><span>Content Manage</span></li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='users'></i><span
                class="menu-title text-truncate" data-i18n="Board">User</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'user.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('user.create') }}"><i
                        data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'user.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('user.index') }}"><i
                        data-feather="list"></i><span class="menu-item text-truncate"
                        data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                class="menu-title text-truncate" data-i18n="Board">Role Group</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'group.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('group.create') }}"><i
                        data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'group.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('group.index') }}"><i
                        data-feather="list"></i><span class="menu-item text-truncate"
                        data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                class="menu-title text-truncate" data-i18n="Board">Role</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'role.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('role.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'role.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('role.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                class="menu-title text-truncate" data-i18n="Board">Permission</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'permission.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('permission.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'permission.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('permission.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                class="menu-title text-truncate" data-i18n="Board">Role Permission</span></a>
        <ul class="menu-content">

            <li class="{{ Route::currentRouteName() === 'role-permission.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('role-permission.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='image'></i><span
                class="menu-title text-truncate" data-i18n="Board">Categories</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'banner.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'banner.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='image'></i><span
                class="menu-title text-truncate" data-i18n="Board">Gift Card</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'banner.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'banner.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='image'></i><span
                class="menu-title text-truncate" data-i18n="Board">Reward Modules</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'banner.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'banner.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>


    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='compass'></i><span
                class="menu-title text-truncate" data-i18n="Board">Shipping Plan</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'plan.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('plan.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New
                        Plan</span></a></li>
            <li class="{{ Route::currentRouteName() === 'plan.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('plan.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">Plan
                        List</span></a></li>
        </ul>
    </li>
    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='compass'></i><span
                class="menu-title text-truncate" data-i18n="Board">Weight Details</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'weight_details.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('weight_details.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New
                        Weight Details</span></a></li>
            <li class="{{ Route::currentRouteName() === 'weight_details.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('weight_details.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">Weight Details
                        List</span></a></li>
        </ul>
    </li>


    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='compass'></i><span
                class="menu-title text-truncate" data-i18n="Board">Merchant <button class="btn-sm btn-danger"
                    style="padding: 2px;">{{ $homeNotify ? $homeNotify->tmerchent : '' }}</button></span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'merchant.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('merchant.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'merchant.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('merchant.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>



    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='users'></i><span
                class="menu-title text-truncate" data-i18n="Board">Customer <button class="btn-sm btn-danger"
                    style="padding: 2px;">{{ $homeNotify ? $homeNotify->trider : '' }}</button></span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'rider.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('rider.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'rider.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('rider.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='shield'></i><span
                class="menu-title text-truncate" data-i18n="Board">Store Manage</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'store.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('store.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'store.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('store.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span>
                </a>
            </li>

        </ul>
    </li>


    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='image'></i><span
                class="menu-title text-truncate" data-i18n="Board">Brand Manage</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'banner.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'banner.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>


    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='image'></i><span
                class="menu-title text-truncate" data-i18n="Board">Banner</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'banner.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'banner.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='image'></i><span
                class="menu-title text-truncate" data-i18n="Board">Offers</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'banner.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'banner.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='image'></i><span
                class="menu-title text-truncate" data-i18n="Board">FAQ</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'banner.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'banner.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='image'></i><span
                class="menu-title text-truncate" data-i18n="Board">Blog</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'banner.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'banner.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='image'></i><span
                class="menu-title text-truncate" data-i18n="Board">Services</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'banner.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'banner.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='image'></i><span
                class="menu-title text-truncate" data-i18n="Board">Website Menu</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'banner.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'banner.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='image'></i><span
                class="menu-title text-truncate" data-i18n="Board">Menu Content</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'banner.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'banner.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('banner.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='image'></i><span
                class="menu-title text-truncate" data-i18n="Board">Manage Complaints</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'complaint.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('complaint.create') }}"><i
                        data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'complaint.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('complaint.index') }}"><i
                        data-feather="list"></i><span class="menu-item text-truncate"
                        data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>
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

    <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('merchantpaymentreport.index') }}"><i
                data-feather='twitch'></i><span class="menu-title text-truncate" data-i18n="Board">Product
                Report</span></a>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('merchantpaymentreport.index') }}"><i
                data-feather='twitch'></i><span class="menu-title text-truncate" data-i18n="Board">Stock
                Report</span></a>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('merchantpaymentreport.index') }}"><i
                data-feather='twitch'></i><span class="menu-title text-truncate" data-i18n="Board">Order
                Report</span></a>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('merchantpaymentreport.index') }}"><i
                data-feather='twitch'></i><span class="menu-title text-truncate" data-i18n="Board">Invoice
                Report</span></a>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('merchantpaymentreport.index') }}"><i
                data-feather='twitch'></i><span class="menu-title text-truncate" data-i18n="Board">Merchant Payment
                Report</span></a>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center"
            href="{{ route('merchantpaymentreport.allDetails') }}"><i data-feather='twitch'></i><span
                class="menu-title text-truncate" data-i18n="Board">Detailed Merchant Payment
                Report</span></a>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('rider.pickup.report') }}"><i
                data-feather='twitch'></i><span class="menu-title text-truncate" data-i18n="Board">Customer
                Report</span></a>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('rider.delivery.report') }}"><i
                data-feather='twitch'></i><span class="menu-title text-truncate" data-i18n="Board">Merchant
                Report</span></a>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('rider_report') }}"><i
                data-feather='twitch'></i><span class="menu-title text-truncate" data-i18n="Board">Rider
                Report</span></a>
    </li>

    <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('hub.delivery.report') }}"><i
                data-feather='twitch'></i><span class="menu-title text-truncate" data-i18n="Board">Success Delivery
                Report</span></a>
    </li>



    <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='file'></i><span
                class="menu-title text-truncate" data-i18n="Board">Document</span></a>
        <ul class="menu-content">
            <li class="{{ Route::currentRouteName() === 'document.create' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('document.create') }}">
                    <i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="List">New</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'document.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('document.index') }}">
                    <i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="List">View</span></a>
            </li>

        </ul>
    </li>

    <li class="navigation-header text-truncate"><span>Settings</span></li>
    <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="settings"></i><span
                class="menu-title text-truncate" data-i18n="Board">Settings</span></a>
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


            <li class="{{ Route::currentRouteName() === 'subscriptiontype.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('subscriptiontype.index') }}">
                    <span class="menu-item text-truncate" data-i18n="Third Level">
                        <i data-feather="circle"></i>Merchant Subscription Type</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'employeeid.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('employeeid.index') }}">
                    <span class="menu-item text-truncate" data-i18n="Third Level">
                        <i data-feather="circle"></i>Employee ID</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'deliverynote.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('deliverynote.index') }}">
                    <span class="menu-item text-truncate" data-i18n="Third Level">
                        <i data-feather="circle"></i>Delivery Note</span></a>
            </li>

            <li class="{{ Route::currentRouteName() === 'deliverynote.index' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('deliverynote.index') }}">
                    <span class="menu-item text-truncate" data-i18n="Third Level">
                        <i data-feather="circle"></i>Return Causes</span></a>
            </li>


    </li>



</ul>
</li>

</ul>
