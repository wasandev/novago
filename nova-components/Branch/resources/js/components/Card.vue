<template>
 <div class="my-component-scoped flex justify-center items-centers ">
    <div class="w-full">
      <heading class="flex mb-3">Quick Menu</heading>
      <p class="text-90 leading-tight mb-8">
        สำหรับสาขา
      </p>

        <card>
            <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
                <div class="align-top w-1/2 border-r border-b border-50">
                    <a :href="branch1" class="no-underline dim flex p-6   hover:text-blue-500">
                        <div class="flex justify-center w-11 flex-no-shrink mr-6">
                            <svg  class="fill-blue-400" xmlns="http://www.w3.org/2000/svg"  width="40"
                                height="40" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                            </svg>   
                             
                        </div>
                        <div>
                            <heading :level="2" class="mb-3 font-bold text-blue-400">รายการรถเข้าสาขา</heading>
                            <p class="">
                                ดูรายการรถเข้าสาขา
                            </p>
                        </div>
                    </a>
                </div>
                <div class="align-top w-1/2  border-b border-50">
                     <a :href="branch2" class="no-underline dim flex p-6   hover:text-blue-500">
                        <div class="flex justify-center w-11 flex-no-shrink mr-6">
                           <svg class="fill-blue-400"
                            xmlns="http://www.w3.org/2000/svg"
                            width="40"
                            height="40"
                            viewBox="0 0 20 20"
                            >
                             <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>

                           
                           
                        </div>
                        <div>
                            <heading :level="2" class="mb-3  text-blue-400">รายการใบรับส่งเข้าสาขา</heading>
                            <p>
                                รายการใบรับส่งเข้าสาขา
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
                <div class="align-top w-1/2 border-r border-b border-50">
                    <a :href="branch3" class="no-underline dim flex p-6   hover:text-blue-500">
                        <div class="flex justify-center w-11 flex-no-shrink mr-6">
                           <svg xmlns="http://www.w3.org/2000/svg" 
                            class="fill-blue-400" width="40"
                            height="40" viewBox="0 0 20 20" >
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z" clip-rule="evenodd" />
                            </svg>
                            
                        </div>
                        <div>
                            <heading :level="2" class="mb-3  text-blue-400">รายการจัดส่งสินค้าของสาขา</heading>
                            <p class="text-90 leading-normal">
                                รายการจัดส่งสินค้าของสาขา
                            </p>
                            </div>
                        </a>
                </div>
                <div class="align-top w-1/2  border-b border-50">
                    <a :href="branch4" class="no-underline dim flex p-6   hover:text-blue-500">
                        <div class="flex justify-center w-11 flex-no-shrink mr-6">
                           <svg class="fill-blue-400"
                            xmlns="http://www.w3.org/2000/svg"
                            width="40"
                            height="40"
                            viewBox="0 0 20 20"
                            >
                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                           
                            </svg>
                            
                        </div>
                        <div>
                            <heading :level="2" class="mb-3  text-blue-400">รายการเก็บเงินปลายทางของสาขา</heading>
                            <p class="text-90 leading-normal">
                                ดูรายการเก็บเงินปลายทางของสาขา
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
                <div class="align-top w-1/2 border-r border-b border-50">
                    <a :href="branch5" class="no-underline dim flex p-6   hover:text-blue-500">
                        <div class="flex justify-center w-11 flex-no-shrink mr-6">
                           <svg class="fill-blue-400"
                                xmlns="http://www.w3.org/2000/svg"
                                width="40"
                                height="40"
                                viewBox="0 0 20 20"
                                >
                                <path
                                    
                                    d="M18 9.87V20H2V9.87a4.25 4.25 0 0 0 3-.38V14h10V9.5a4.26 4.26 0 0 0 3 .37zM3 0h4l-.67 6.03A3.43 3.43 0 0 1 3 9C1.34 9 .42 7.73.95 6.15L3 0zm5 0h4l.7 6.3c.17 1.5-.91 2.7-2.42 2.7h-.56A2.38 2.38 0 0 1 7.3 6.3L8 0zm5 0h4l2.05 6.15C19.58 7.73 18.65 9 17 9a3.42 3.42 0 0 1-3.33-2.97L13 0z"
                                />
                                </svg>
                            </div>
                            <div>
                                <heading :level="2" class="mb-3  text-blue-400">รายการใบเสร็จรับเงินปลายทาง</heading>
                                <p class="text-90 leading-normal">
                                    ดูรายการใบเสร็จรับเงินปลายทาง
                                </p>
                            </div>
                        </a>
                </div>
                <div class="align-top w-1/2  border-b border-50">
                    <a :href="branch6" class="no-underline dim flex p-6   hover:text-blue-500">
                        <div class="flex justify-center w-11 flex-no-shrink mr-6">
                           <svg class="fill-blue-400"
                            xmlns="http://www.w3.org/2000/svg"
                            width="40"
                            height="40"
                            viewBox="0 0 40 40"
                            >
                            <path
                                fill="var(--primary)"
                                d="M29 7h5c.5522847 0 1 .44771525 1 1s-.4477153 1-1 1h-5v5c0 .5522847-.4477153 1-1 1s-1-.4477153-1-1V9h-5c-.5522847 0-1-.44771525-1-1s.4477153-1 1-1h5V2c0-.55228475.4477153-1 1-1s1 .44771525 1 1v5zM4 0h8c2.209139 0 4 1.790861 4 4v8c0 2.209139-1.790861 4-4 4H4c-2.209139 0-4-1.790861-4-4V4c0-2.209139 1.790861-4 4-4zm0 2c-1.1045695 0-2 .8954305-2 2v8c0 1.1.9 2 2 2h8c1.1045695 0 2-.8954305 2-2V4c0-1.1045695-.8954305-2-2-2H4zm20 18h8c2.209139 0 4 1.790861 4 4v8c0 2.209139-1.790861 4-4 4h-8c-2.209139 0-4-1.790861-4-4v-8c0-2.209139 1.790861-4 4-4zm0 2c-1.1045695 0-2 .8954305-2 2v8c0 1.1.9 2 2 2h8c1.1045695 0 2-.8954305 2-2v-8c0-1.1045695-.8954305-2-2-2h-8zM4 20h8c2.209139 0 4 1.790861 4 4v8c0 2.209139-1.790861 4-4 4H4c-2.209139 0-4-1.790861-4-4v-8c0-2.209139 1.790861-4 4-4zm0 2c-1.1045695 0-2 .8954305-2 2v8c0 1.1.9 2 2 2h8c1.1045695 0 2-.8954305 2-2v-8c0-1.1045695-.8954305-2-2-2H4z"
                            />
                            </svg>

                        </div>
                        <div>
                            <heading :level="3" class="mb-3  text-blue-400">ใบรับส่งสินค้า</heading>
                            <p class="text-90 leading-normal">
                                ค้นหา ดู สร้าง แก้ไข ใบรับส่งสินค้าจากสาขา
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
                <div class="align-top w-1/2 border-r border-b border-50">
                    <a :href="branch7" class="no-underline dim flex p-6   hover:text-blue-500">
                        <div class="flex justify-center w-11 flex-no-shrink mr-6">
                           <svg class="fill-blue-400"
                                xmlns="http://www.w3.org/2000/svg"
                                width="40"
                                height="40"
                                viewBox="0 0 20 20"
                                >
                                <path
                                    fill="var(--primary)"
                                    d="M18 9.87V20H2V9.87a4.25 4.25 0 0 0 3-.38V14h10V9.5a4.26 4.26 0 0 0 3 .37zM3 0h4l-.67 6.03A3.43 3.43 0 0 1 3 9C1.34 9 .42 7.73.95 6.15L3 0zm5 0h4l.7 6.3c.17 1.5-.91 2.7-2.42 2.7h-.56A2.38 2.38 0 0 1 7.3 6.3L8 0zm5 0h4l2.05 6.15C19.58 7.73 18.65 9 17 9a3.42 3.42 0 0 1-3.33-2.97L13 0z"
                                />
                                </svg>
                            </div>
                            <div>
                                <heading :level="2" class="mb-3  text-blue-400">รายการเก็บเงินปลายทางของสาขา</heading>
                                <p class="text-90 leading-normal">
                                    ดูรายการเก็บเงินปลายทางของสาขา
                                </p>
                            </div>
                        </a>
                </div>
                <div class="align-top w-1/2  border-b border-50">
                    <a :href="branch8" class="no-underline dim flex p-6   hover:text-blue-500">
                        <div class="flex justify-center w-11 flex-no-shrink mr-6">
                           <svg class="fill-blue-400"
                            xmlns="http://www.w3.org/2000/svg"
                            width="40"
                            height="40"
                            viewBox="0 0 20 20"
                            >
                            <path
                                fill="var(--primary)"
                                d="M7 3H2v14h5V3zm2 0v14h9V3H9zM0 3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3zm3 1h3v2H3V4zm0 3h3v2H3V7zm0 3h3v2H3v-2z"
                            />
                            </svg>

                        </div>
                        <div>
                            <heading :level="3" class="mb-3  text-blue-400">ใบกำกับสินค้า</heading>
                            <p class="text-90 leading-normal">
                                ค้นหา ดู สร้าง แก้ไข ใบกำกับสินค้าของสาขา
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
                <div class="align-top w-1/2 border-r border-b border-50">
                    <a :href="branch9" class="no-underline dim flex p-6   hover:text-blue-500">
                        <div class="flex justify-center w-11 flex-no-shrink mr-6">
                           <svg class="fill-blue-400"
                            xmlns="http://www.w3.org/2000/svg"
                            width="40"
                            height="40"
                            viewBox="0 0 20 20"
                            >
                            <path
                                fill="var(--primary)"
                                d="M1 4h2v2H1V4zm4 0h14v2H5V4zM1 9h2v2H1V9zm4 0h14v2H5V9zm-4 5h2v2H1v-2zm4 0h14v2H5v-2z"
                            />
                            </svg>
                        </div>
                        <div>
                            <heading :level="2" class="mb-3  text-blue-400">ค่าขนส่ง</heading>
                            <p class="text-90 leading-normal">
                                ค้นหา ดูข้อมูลราคาค่าขนส่งสินค้า
                            </p>
                        </div>
                    </a>
                </div>
                <div class="align-top w-1/2  border-b border-50">
                    <a :href="branch10" class="no-underline dim flex p-6   hover:text-blue-500">
                        <div class="flex justify-center w-11 flex-no-shrink mr-6">
                           <svg class="fill-blue-400"
                            xmlns="http://www.w3.org/2000/svg"
                            width="40"
                            height="40"
                            viewBox="0 0 20 20"
                            >
                            <path
                                fill="var(--primary)"
                                d="M7 8a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0 1c2.15 0 4.2.4 6.1 1.09L12 16h-1.25L10 20H4l-.75-4H2L.9 10.09A17.93 17.93 0 0 1 7 9zm8.31.17c1.32.18 2.59.48 3.8.92L18 16h-1.25L16 20h-3.96l.37-2h1.25l1.65-8.83zM13 0a4 4 0 1 1-1.33 7.76 5.96 5.96 0 0 0 0-7.52C12.1.1 12.53 0 13 0z"
                            />
                            </svg>
                        </div>
                        <div>
                            <heading :level="2" class="mb-3  text-blue-400">ข้อมูลลูกค้า</heading>
                            <p class="text-90 leading-normal">
                                ค้นหา ดู แก้ไข เพิ่มข้อมูลลูกค้า
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
                <div class="align-top w-1/2 border-r  border-50">
                    <a :href="branch11" class="no-underline dim flex p-6   hover:text-blue-500">
                        <div class="flex justify-center w-11 flex-no-shrink mr-6">
                           <svg class="fill-red-500"
                            xmlns="http://www.w3.org/2000/svg"
                            width="40"
                            height="40"
                            viewBox="0 0 20 20"
                            >
                            <path
                                
                                d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm5-9v2H5V9h10z"
                            />
                            </svg>
                        </div>
                        <div>
                            <heading :level="2" class="mb-2 text-blue-400">รายการสินค้ามีปัญหา</heading>
                            <p class="text-90 leading-normal">
                                ค้นหา ดู แก้ไข รายการสินค้ามีปัญหา สูญหาย เสียหาย
                            </p>
                        </div>
                    </a>
                </div>
                <div class="align-top w-1/2 ">
                    <a :href="branch12" class="no-underline dim flex p-6   hover:text-blue-500">
                        <div class="flex justify-center w-11 flex-no-shrink mr-6">
                           <svg class="fill-blue-400"
                            xmlns="http://www.w3.org/2000/svg"
                            width="40"
                            height="40"
                            viewBox="0 0 20 20"
                            >
                            <path
                                fill="var(--primary)"
                                d="M5 5a5 5 0 0 1 10 0v2A5 5 0 0 1 5 7V5zM0 16.68A19.9 19.9 0 0 1 10 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z"
                            />
                            </svg>
                        </div>
                        <div>
                            <heading :level="2" class="mb-3 text-blue-400">ข้อมูลผู้ใช้</heading>
                            <p class="text-90 leading-normal">
                                แก้ไขรายละเอียดบัญชีผู้ใช้ของตัวเอง
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </card>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Billing',

  props: {
    card: Object,
  },
  methods: {
    link(path) {
        return `${path}`
    },
  },
  computed: {
    branch1() {
        return this.link('/app/resources/branchrec_waybills')
    },
    branch2() {
        return this.link('/app/resources/branchrec_orders')
    },
    branch3() {
        return this.link('/app/resources/deliveries')
    },
    branch4() {
        return this.link('/app/resources/branch_balances')
    },
    branch5() {
        return this.link('/app/resources/receipts')
    },
    branch6() {
        return this.link('/app/resources/order_headers')
    },
    branch7() {
        return this.link('/app/resources/branch_balances')
    },
    branch8() {
        return this.link('/app/resources/waybills')
    },
    branch9() {
        return this.link('/app/resources/product_services')
    },
    branch10() {
        return this.link('/app/resources/customers')
    },
    branch11() {
        return this.link('/app/resources/order_problems')
    },
    branch12() {
        return this.link('/app/resources/users')
    },
  },
}
</script>
