<template>
  <div class="my-component-scoped flex justify-center items-centers ">
    <div class="w-full">
      <heading class="flex mb-3">Quick Menu</heading>
      <p class="text-90 leading-tight mb-8">
        สำหรับฝ่ายบัญชี
      </p>

      <card>
        <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
            <div class="align-top w-1/2 border-r border-b border-50">

            <a :href="account1" class="no-underline dim flex p-6   hover:text-blue-500">
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
                        <heading :level="2" class="mb-3">ใบรับส่งสินค้า</heading>
                          <p class="text-90 leading-normal">
                            ค้นหา ดู ใบรับส่งสินค้า
                          </p>
                      </div>
                    </a>
            </div>
            <div class="align-top w-1/2  border-b border-50">
                <a :href="account2" class="no-underline dim flex p-6   hover:text-blue-500">
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
                        <heading :level="2" class="mb-3">ใบกำกับสินค้า</heading>
                          <p class="text-90 leading-normal">
                            ดู ใบกำกับสินค้า
                          </p>
                      </div>
                    </a>
            </div>
        </div>

        <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
            <div class="align-top w-1/2 border-r border-b border-50">
                <a :href="account3" class="no-underline dim flex p-6   hover:text-blue-500">
                      <div class="flex justify-center w-11 flex-no-shrink mr-6">
                        <svg class="fill-blue-400"
                          xmlns="http://www.w3.org/2000/svg"
                          width="40"
                          height="40"
                          viewBox="0 0 20 20"
                        >
                          <path
                            fill="var(--primary)"
                            d="M16 2h4v15a3 3 0 0 1-3 3H3a3 3 0 0 1-3-3V0h16v2zm0 2v13a1 1 0 0 0 1 1 1 1 0 0 0 1-1V4h-2zM2 2v15a1 1 0 0 0 1 1h11.17a2.98 2.98 0 0 1-.17-1V2H2zm2 8h8v2H4v-2zm0 4h8v2H4v-2zM4 4h8v4H4V4z"
                          />
                        </svg>

                      </div>
                      <div>
                        <heading :level="2" class="mb-3">บัญชีรถ</heading>
                          <p class="text-90 leading-normal">
                            ค้นหา ดู บัญชีรับ-จ่ายของรถ
                          </p>
                      </div>
                    </a>
            </div>

            <div class="align-top w-1/2  border-b border-50">
                <a :href="account4" class="no-underline dim flex p-6   hover:text-blue-500">
                      <div class="flex justify-center w-11 flex-no-shrink mr-6">
                        <svg class="fill-blue-400"
                          xmlns="http://www.w3.org/2000/svg"
                          width="40"
                          height="40"
                          viewBox="0 0 20 20"
                        >
                          <path
                            fill="var(--primary)"
                            d="M0 10a10 10 0 1 1 20 0 10 10 0 0 1-20 0zm2 0a8 8 0 1 0 16 0 8 8 0 0 0-16 0zm8-2h5v4h-5v3l-5-5 5-5v3z"
                          />
                        </svg>
                      </div>
                      <div>
                        <heading :level="2" class="mb-3">จ่ายเงินรถ</heading>
                          <p class="text-90 leading-normal">
                            ค้นหา ดู แก้ไข พิมพ์ รายการจ่ายเงินรถ
                          </p>
                      </div>
                    </a>
            </div>
        </div>

        <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
            <div class="align-top w-1/2 border-r border-b border-50">
                <a :href="account5" class="no-underline dim flex p-6   hover:text-blue-500">
                      <div class="flex justify-center w-11 flex-no-shrink mr-6">
                        <svg class="fill-blue-400"
                          xmlns="http://www.w3.org/2000/svg"
                          width="40"
                          height="40"
                          viewBox="0 0 20 20"
                        >
                          <path
                            fill="var(--primary)"
                            d="M20 10a10 10 0 1 1-20 0 10 10 0 0 1 20 0zm-2 0a8 8 0 1 0-16 0 8 8 0 0 0 16 0zm-8 2H5V8h5V5l5 5-5 5v-3z"
                          />
                        </svg>
                      </div>
                      <div>
                        <heading :level="2" class="mb-3">รับเงินรถ</heading>
                          <p class="text-90 leading-normal">
                            ค้นหา ดู แก้ไข พิมพ์ รายการรับเงินรถ
                          </p>
                      </div>
                    </a>
            </div>

            <div class="align-top w-1/2 border-b border-50">
                <a :href="account6" class="no-underline dim flex p-6   hover:text-blue-500">
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
                        <heading :level="2" class="mb-3">รายการเก็บเงินปลายทางของสาขา</heading>
                          <p class="text-90 leading-normal">
                            ดูรายการเก็บเงินปลายทางของสาขา
                          </p>
                      </div>
                    </a>
            </div>
        </div>

        <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
            <div class="align-top w-1/2 border-r border-50">
                <a :href="account7" class="no-underline dim flex p-6   hover:text-blue-500">
                      <div class="flex justify-center w-11 flex-no-shrink mr-6">
                        <svg class="fill-blue-400"
                          xmlns="http://www.w3.org/2000/svg"
                          width="40"
                          height="40"
                          viewBox="0 0 20 20"
                        >
                          <path
                            fill="var(--primary)"
                            d="M9 10V8h2v2h2v2h-2v2H9v-2H7v-2h2zm-5 8h12V6h-4V2H4v16zm-2 1V0h12l4 4v16H2v-1z"
                          />
                        </svg>
                      </div>
                      <div>
                        <heading :level="2" class="mb-3">ใบเสร็จรับเงิน</heading>
                          <p class="text-90 leading-normal">
                            ดู แก้ไข เพิ่ม พิมพ์ ใบเสร็จรับเงิน
                          </p>
                      </div>
                    </a>
            </div>

            <div class="align-top w-1/2 ">
                <a :href="account8" class="no-underline dim flex p-6   hover:text-blue-500">
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
                        <heading :level="2" class="mb-3">ข้อมูลผู้ใช้</heading>
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
  name: 'Account',

  props: {
    card: Object,
  },
  methods: {
    link(path) {
      return `${path}`
    },
  },
  computed: {
    account1() {
      return this.link('/app/resources/order_headers')
    },
    account2() {
      return this.link('/app/resources/waybills')
    },
    account3() {
      return this.link('/app/resources/car_balances')
    },
    account4() {
      return this.link('/app/resources/carpayments')
    },
    account5() {
      return this.link('/app/resources/carreceives')
    },
    account6() {
      return this.link('/app/resources/branch_balances')
    },
    account7() {
      return this.link('/app/resources/receipt_alls')
    },
    account8() {
      return this.link('/app/resources/users')
    },
    
  },
}
</script>
