<template>
  <div class="my-component-scoped flex justify-center items-centers ">
    <div class="w-full">
      <heading class="flex mb-3">Quick Menu</heading>
      <p class="text-90 leading-tight mb-8">
        สำหรับฝ่ายเร่งรัด
      </p>

        <card>
            <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
                <div class="align-top w-1/2 border-r border-b border-50">
                    <a :href="araccount1" class="no-underline dim flex p-6   hover:text-blue-500">
                        <div class="flex justify-center w-11 flex-no-shrink mr-6">
                            <svg class="fill-blue-400"
                            xmlns="http://www.w3.org/2000/svg"
                            width="40"
                            height="40"
                            viewBox="0 0 20 20"
                            >
                            <path
                                fill="var(--primary)"
                                d="M0 2C0 .9.9 0 2 0h16a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm14 12h4V2H2v12h4c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2zM5 9l2-2 2 2 4-4 2 2-6 6-4-4z"
                            />
                            </svg>

                        </div>
                        <div>
                            <heading :level="2" class="mb-3">รายการใบรับส่งวางบิล</heading>
                            <p class="text-90 leading-normal">
                                ค้นหา ดู รายการใบรับส่งวางบิล
                            </p>
                        </div>
                    </a>
                </div>

                <div class="align-top w-1/2 border-b border-50">
                    <a :href="araccount2" class="no-underline dim flex p-6   hover:text-blue-500">
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
                            <heading :level="2" class="mb-3">ใบแจ้งหนี้</heading>
                            <p class="text-90 leading-normal">
                                ดู แก้ไข เพิ่ม พิมพ์ ใบแจ้งหนี้
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
                <div class="align-top w-1/2 border-r border-b border-50">
                    <a :href="araccount3" class="no-underline dim flex p-6   hover:text-blue-500">
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
                            <heading :level="2" class="mb-3">ใบเสร็จรับเงินวางบิล</heading>
                            <p class="text-90 leading-normal">
                                ค้นหา ดู แก้ไข เพิ่มใบเสร็จรับเงินวางบิล
                            </p>
                        </div>
                    </a>
                </div>
                <div class="align-top w-1/2  border-b border-50">
                   <a :href="araccount4" class="no-underline dim flex p-6   hover:text-blue-500">
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
                            <heading :level="2" class="mb-3">ข้อมูลลูกค้าวางบิล</heading>
                            <p class="text-90 leading-normal">
                                ค้นหา ดู แก้ไข เพิ่มข้อมูลลูกค้าวางบิล
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="w-full flex flex-wrap" cellpadding="10" cellspacing="10">
                <div class="align-top w-1/2 border-r  border-50">
                    <a :href="araccount5" class="no-underline dim flex p-6   hover:text-blue-500">
                        <div class="flex justify-center w-11 flex-no-shrink mr-6">
                            <svg class="fill-blue-400"
                            xmlns="http://www.w3.org/2000/svg"
                            width="40"
                            height="40"
                            viewBox="0 0 20 20"
                            >
                            <path
                                fill="var(--primary)"
                                d="M0 2C0 .9.9 0 2 0h16a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm14 12h4V2H2v12h4c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2zM5 9l2-2 2 2 4-4 2 2-6 6-4-4z"
                            />
                            </svg>
                        </div>
                        <div>
                            <heading :level="2" class="mb-3">รายการโอนเงินค่าขนส่ง</heading>
                            <p class="text-90 leading-normal">
                                ค้นหา ดู จัดการ รายการโอนเงินค่าขนส่ง
                            </p>
                        </div>
                    </a>
                </div>

                <div class="align-top w-1/2 ">
                    <a :href="araccount6" class="no-underline dim flex p-6   hover:text-blue-500">
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
  name: 'Araccount',

  props: {
    card: Object,
  },
  methods: {
    link(path) {
      return `${path}`
    },
  },
  computed: {
    araccount1() {
      return this.link('/app/resources/ar_balances')
    },
    araccount2() {
      return this.link('/app/resources/invoices')
    },
    araccount3() {
      return this.link('/app/resources/receipt_ars')
    },
    araccount4() {
      return this.link('/app/resources/ar_customers')
    },
    araccount5() {
      return this.link('/app/resources/order_banktransfers')
    },
    araccount6() {
      return this.link('/app/resources/users')
    },
   
    
  },
}
</script>
