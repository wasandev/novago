<template>
  <div class="my-component-scoped flex justify-center items-centers ">
    <div class="w-full">
      <heading class="flex mb-3">Quick Menu</heading>
      <p class="text-90 leading-tight mb-8">
        สำหรับพนักงานจัดขึ้นสินค้า
      </p>
       <card>
            <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
                <div class="align-top w-1/2 border-b border-r border-50">
                    <a :href="loading1" class="no-underline dim flex p-6   hover:text-blue-500">
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
                        <div class="mt-3">
                            <heading :level="2" class="align-middle">ตรวจรับสินค้า</heading>
                            <p class="text-90 leading-normal">
                                รายการตรวจรับสินค้า
                          </p>
                        </div>
                    </a>
                </div>

                <div class="align-top w-1/2 border-b  border-50 ">
                   <a :href="loading2" class="no-underline dim flex p-6   hover:text-blue-500">
                        <div class="flex justify-center w-11 flex-no-shrink mr-6">
                            <svg class="fill-blue-400"
                            xmlns="http://www.w3.org/2000/svg"
                            width="40"
                            height="40"
                            viewBox="0 0 20 20"
                            >
                            <path
                                fill="var(--primary)"
                                d="M4 10c0-1.1.9-2 2-2h8c1.1 0 2 .9 2 2v8c0 1.1-.9 2-2 2H6c-1.1 0-2-.9-2-2v-8zm2 0v8h8v-8h-2V8H8v2H6zm3-6.17V16h2V3.83l3.07 3.07 1.42-1.41L10 0l-.7.7L4.5 5.5l1.42 1.4L9 3.84z"
                            />
                            </svg>
                        </div>
                        <div class="mt-3">
                            <heading :level="2" class="mb-3">รายการจัดขึ้นสินค้า</heading>
                            <p class="text-90 leading-normal">
                                ทำรายการจัดสินค้าขึ้นรถบรรทุก
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">

                <div class="align-top w-1/2 border-b border-r border-50 ">
                    <a :href="loading3" class="no-underline dim flex p-6   hover:text-blue-500">
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
                        <div class="mt-3">
                            <heading :level="2" class="mb-3">ใบกำกับสินค้า</heading>
                            <p class="text-90 leading-normal">
                                รายการใบกำกับสินค้า
                            </p>

                        </div>
                    </a>
                </div>
                <div class="align-top w-1/2 border-b  border-50  ">
                   <a :href="loading4" class="no-underline dim flex p-6   hover:text-blue-500">
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
                        <div class="mt-3">
                            <heading :level="2" class="mb-3">ข้อมูลลูกค้า</heading>
                            <p class="text-90 leading-normal">
                                เพิ่ม บันทึก แก้ไข ข้อมูลสินค้า
                          </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
                <div class="align-top w-1/2  border-r border-50">
                   <a :href="loading5" class="no-underline dim flex p-6   hover:text-blue-500">
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
                        <div class="mt-3">
                            <heading :level="2" >ดูราคาค่าขนส่งสินค้า</heading>
                            <p class="text-90 leading-normal">
                                ดู ค้นหา ค่าขนส่งสินค้า
                          </p>
                        </div>
                    </a>
                </div>

                <div class="align-top w-1/2 ">
                    <a :href="loading6" class="no-underline dim flex p-6   hover:text-blue-500">
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
                        <div class="mt-2">
                            <heading :level="2" class="mb-3">ข้อมูลผู้ใช้</heading>
                            <p class="text-90 leading-normal">
                                ดู แก้ไข ข้อมูลผู้ใช้
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
  name: 'Loading',

  props: {
    card: Object,
  },
  methods: {
    link(path) {
      return `${path}`
    },
  },
  computed: {
    loading1() {
      return this.link('/app/resources/order_checking')
    },
    loading2() {
      return this.link('/app/resources/order_loaders')
    },
    loading3() {
      return this.link('/app/resources/waybills')
    },
    loading4() {
      return this.link('/app/resources/customers')
    },
   loading5() {
      return this.link('/app/resources/product_service_prices')
    },
   loading6() {
      return this.link('/app/resources/users')
    },
    
  },
}
</script>
