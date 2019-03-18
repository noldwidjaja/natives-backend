<?php

return [
    /*
     * Business Modules
     */
    Acme\Module\Category\AcmeCategoryModule::class,
    Acme\Module\Cart\AcmeCartModule::class,
    Acme\Module\Customer\AcmeCustomerModule::class,
    Acme\Module\Gender\AcmeGenderModule::class,
    Acme\Module\Image\AcmeImageModule::class,
    Acme\Module\Item\AcmeItemModule::class,
    Acme\Module\Login\AcmeLoginModule::class,
    Acme\Module\Payment\AcmePaymentModule::class,
    Acme\Module\Role\AcmeRoleModule::class,
    Acme\Module\Supplier\AcmeSupplierModule::class,
    Acme\Module\Transaction\AcmeTransactionModule::class,
    Acme\Module\Type\AcmeTypeModule::class,
    Acme\Module\Wishlist\AcmeWishlistModule::class,
    Acme\Module\Bought\AcmeBoughtModule::class,
    /*
     * Application Modules
     */
    Acme\Api\AcmeApiModule::class,
    Acme\Web\AcmeWebModule::class,
];
