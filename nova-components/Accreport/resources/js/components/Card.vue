<template>
  <div class="my-component-scoped flex justify-center items-centers ">
    <div class="w-full">
      <heading class="flex mb-3 text-bold text-blue-500 ">Quick Reports Menu</heading>
      <p class="text-90 leading-tight mb-8">
        รวม Link รายงานต่างๆ
      </p>

      
        <div class="w-full flex flex-wrap" >
          
          <div class="item-center w-1/2  ">
            <card class="p-2 m-2">
              <a :href="report1" class="no-underline dim flex p-6   hover:text-blue-500">

                <div class="flex justify-center w-11 flex-no-shrink mr-6">
                  <svg class="fill-blue-500 hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" 
                      width="60" 
                      height="60" 
                      viewBox="0 0 20 20">
                    <path 
                      d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                  </svg>

                </div>
                <div class="mt-3">
                  <heading :level="3" class="mb-3 font-bold">รายงานเงินสดรับ ตามพนักงาน</heading>

                </div>

              </a>
            </card>
          </div>
          
          
          <div class="item-center w-1/2">
            <card class="p-2 m-2">
            <a :href="report2" class="no-underline dim flex p-6   hover:text-blue-500 ">

              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path fill="bg-blue-500"
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานรายการขนส่งประจำวัน</heading>

              </div>
            </a>
          </card>

          </div>
          
        </div>

        <div class="w-full flex flex-wrap">
          <div class="align-top w-1/2  ">
            <card class="p-2 m-2">
            <a :href="report3" class="no-underline dim flex p-6  hover:text-blue-500">

              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg  class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานยอดค่าขนส่งตามวัน</heading>

              </div>
            </a>
            </card>
          </div>

          <div class="align-top w-1/2 ">
            <card class="p-2 m-2">
            <a :href="report4" class="no-underline dim flex p-6   hover:text-blue-500">

              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg  class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path 
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานยอดค่าขนส่งตามสาขาปลายทาง</heading>

              </div>
            </a>
            </card>
          </div>
        </div>

        <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
          <div class="align-top w-1/2  ">
            <card class="p-2 m-2">
            <a :href="report5" class="no-underline dim flex p-6  hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path 
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานรายการยกเลิกใบรับส่ง</heading>

              </div>
            </a>
            </card>
          </div>
          <div class="align-top w-1/2  ">
            <card class="p-2 m-2">
            <a :href="report6" class="no-underline dim flex p-6  hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg  class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path 
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานขายสดประจำวัน</heading>

              </div>
            </a>
            </card>
          </div>
        </div>
        <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
          <div class="align-top w-1/2 ">
            <card class="p-2 m-2">
            <a :href="report7" class="no-underline dim flex p-6   hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path 
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานขายเชื่อประจำวัน</heading>

              </div>
            </a>
          </card>
          </div>

          <div class="align-top w-1/2  ">
            <card class="p-2 m-2">
            <a :href="report8" class="no-underline dim flex p-6   hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path 
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานรถออกประจำวัน</heading>

              </div>
            </a>
          </card>
          </div>
        </div>
        <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
          <div class="align-top w-1/2 ">
            <card class="p-2 m-2">
            <a :href="report9" class="no-underline dim flex p-6   hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path 
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานสรุปรับเงินรถ</heading>

              </div>
            </a>
          </card>
          </div>
          <div class="align-top w-1/2 ">
            <card class="p-2 m-2">
            <a :href="report10" class="no-underline dim flex p-6  hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path 
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานสรุปจ่ายเงินรถ</heading>

              </div>
            </a>
          </card>
          </div>
        </div>
        <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
          <div class="align-top w-1/2 ">
            <card class="p-2 m-2">
            <a :href="report11" class="no-underline dim flex p-6   hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path 
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานบัญชีคุมรถบรรทุก</heading>

              </div>
            </a>
            </card>
          </div>
          <div class="align-top w-1/2  ">
            <card class="p-2 m-2">
            <a :href="report12" class="no-underline dim flex p-6  hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path 
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานสรุปยอดคงเหลือรถ</heading>

              </div>
            </a>
          </card>
          </div>
        </div>
        <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
          <div class="align-top w-1/2 ">
            <card class="p-2 m-2">
            <a :href="report13" class="no-underline dim flex p-6   hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path 
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานภาษีหัก ณ ที่จ่ายรถ</heading>

              </div>
            </a>
          </card>
          </div>
          <div class="align-top w-1/2 ">
            <card class="p-2 m-2">

            <a :href="report14" class="no-underline dim flex p-6   hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path 
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานรถออกประจำเดือน</heading>

              </div>
            </a>
          </card>
          </div>
        </div>
        <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
          <div class="align-top w-1/2 ">
            <card class="p-2 m-2">
            <a :href="report15" class="no-underline dim flex p-6  hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path 
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานลูกหนี้ค้างชำระ</heading>

              </div>
            </a>
          </card>
          </div>
          <div class="align-top w-1/2 ">
            <card class="p-2 m-2">
            <a :href="report16" class="no-underline dim flex p-6   hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path 
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานรับชำระหนี้ลูกหนี้การค้า</heading>

              </div>
            </a>
          </card>
          </div>
        </div>
        <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
          <div class="align-top w-1/2 ">
            <card class="p-2 m-2">
            <a :href="report17" class="no-underline dim flex p-6  hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path 
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานทะเบียนคุมลูกหนี้</heading>

              </div>
            </a>
          </card>
          </div>
          <div class="align-top w-1/2 ">
            <card class="p-2 m-2">
            <a :href="report18" class="no-underline dim flex p-6   hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานสรุปยอดลูกหนี้การค้า</heading>

              </div>
            </a>
          </card>
          </div>
        </div>
        <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
          <div class="align-top w-1/2 ">
            <card class="p-2 m-2">
            <a :href="report19" class="no-underline dim flex p-6   hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path 
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานตั้งหนี้ลูกหนี้สาขา</heading>

              </div>
            </a>
          </card>
          </div>
          <div class="align-top w-1/2  ">
            <card class="p-2 m-2">
            <a :href="report20" class="no-underline dim flex p-6   hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path 
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานรับชำระหนี้ลูกหนี้สาขา</heading>

              </div>
            </a>
          </card>
          </div>
        </div>
        <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
          <div class="align-top w-1/2 " >
            <card class="p-2 m-2">
            <a :href="report21" class="no-underline dim flex p-6   hover:text-blue-500">
              <div class="flex justify-center w-11 flex-no-shrink mr-6">
                <svg class="fill-blue-500  hover:fill-gray-950" xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 20 20">
                  <path
                    d="M4 16H0V6h20v10h-4v4H4v-4zm2-4v6h8v-6H6zM4 0h12v5H4V0zM2 8v2h2V8H2zm4 0v2h2V8H6z" />
                </svg>

              </div>
              <div class="mt-3">
                <heading :level="3" class="mb-3 font-bold">รายงานลูกหนี้สาขาค้างชำระ</heading>

              </div>
            </a>
            </card>
          </div>
          <div class="align-top w-1/2 ">

          </div>
        </div>
      <!-- </card> -->
    </div>
  </div>
</template>

<script>
export default {
  name: 'Accreport',

  props: {
    card: Object,
  },
  methods: {
    link(path) {
      return `${path}`
    },
  },
  computed: {
    report1() {
      return this.link('/app/resources/order_headers/lens/order-billing-cash')
    },
    report2() {
      return this.link('/app/resources/order_headers/lens/accounts-order-report-bill-by-day')
    },
    report3() {
      return this.link('/app/resources/order_headers/lens/accounts-order-report-by-day')
    },
    report4() {
      return this.link('/app/resources/order_headers/lens/accounts-order-report-by-branchrc')
    },
    report5() {
      return this.link('/app/resources/order_headers/lens/accounts-order-report-cancel-by-day')
    },
    report6() {
      return this.link('/app/resources/order_headers/lens/accounts-order-report-cash-by-day')
    },
    report7() {
      return this.link('/app/resources/order_headers/lens/accounts-order-report-cr-by-day')
    },
    report8() {
      return this.link('/app/resources/waybills/lens/waybill-confirmed-per-day')
    },
    report9() {
      return this.link('/app/resources/cars/lens/accounts-carreceive-report-by-day')
    },
    report10() {
      return this.link('/app/resources/cars/lens/accounts-carpayment-report-by-day')
    },
    report11() {
      return this.link('/app/resources/cars/lens/cars-carcard-report')
    },
    report12() {
      return this.link('/app/resources/cars/lens/cars-summary-report')
    },
    report13() {
      return this.link('/app/resources/vendors/lens/carpay-tax')
    },
    report14() {
      return this.link('/app/resources/waybills/lens/waybill-confirmed-per-month')
    },
    report15() {
      return this.link('/app/resources/ar_customers/lens/ar-outstanding-report')
    },
    report16() {
      return this.link('/app/resources/ar_customers/lens/ar-receipt-report')
    },
    report17() {
      return this.link('/app/resources/ar_customers/lens/ar-card-report')
    },
    report18() {
      return this.link('/app/resources/ar_customers/lens/ar-summary-report')
    },
    report19() {
      return this.link('/app/resources/branch_balances/lens/branch-branch-balance-bydate')
    },
    report20() {
      return this.link('/app/resources/branch_balances/lens/branch-branch-balance-receipt')
    },
    report21() {
      return this.link('/app/resources/branch_balances/lens/branch-branch-balance-report')
    },
  },
}
</script>
