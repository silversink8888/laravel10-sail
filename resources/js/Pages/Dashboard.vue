<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, Head } from '@inertiajs/vue3';
import PrimaryButton from '../Components/PrimaryButton.vue';

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        LINE PAY
                    </h2>
                </header>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <PrimaryButton   onClick="window.open('/payment/linepay/geturl/1','_blank','')">
                            LINE Payで支払う
                        </PrimaryButton>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div>
                            <PrimaryButton>
                                <a href="/payment/linepay/geturl/1" target="_blank">LINE Payで支払う</a>
                            </PrimaryButton>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
    </AuthenticatedLayout>
</template>
