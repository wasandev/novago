<template>
  <card class="flex flex-col  justify-center">
    <div class="px-3 py-3">
      <h1 class="text-left text-2xl  text-blue-500">
        สถานะใบรับส่ง
      </h1>

      <table class="w-full" cellpadding="0" cellspacing="0">
        <tr>
          <td class="font-bold text-red-500">
            1.Checking = กำลังตรวจรับสินค้า
          </td>
          <td class="font-bold text-red-500">
            2.New = ยืนยันการตรวจรับสินค้าแล้ว
          </td>
        </tr>
        <tr>
          <td class="font-bold text-red-500">
            3.Confirmed = สาขาต้นทางรับสินค้าไว้แล้ว
          </td>
          <td class="font-bold text-red-500">
            4.Loaded = จัดสินค้าขึ้นรถแล้ว
          </td>
        </tr>
        <tr>
          <td class="font-bold text-red-500">
            5.In transit = สินค้าอยู่ระหว่างขนส่งไปสาขา
          </td>
          <td class="font-bold text-red-500">
            6.Arrival = สินค้าอยู่สาขาปลายทาง
          </td>
        </tr>
        <tr>
          <td class="font-bold text-red-500">
            7.Branch warehouse = สินค้าอยู่คลังสาขารอการจัดส่ง
          </td>
          <td class="font-bold text-red-500">
            8.Delivery = สินค้าอยู่ระหว่างการจัดส่ง
          </td>
        </tr>
        <tr>
          <td class="font-bold text-red-500">
            9.Completed = สินค้าจัดส่งถึงผู้รับปลายทางแล้ว
          </td>
          <td class="font-bold text-red-500">
            10.Cancel = ยกเลิกรายการแล้ว
          </td>
        </tr>
        <tr>
          <td class="font-bold text-red-500">
            11.Problem = มีปัญหาการขนส่ง
          </td>
          <td></td>
        </tr>
      </table>
    </div>
  </card>
</template>

<script>
export default {
  props: [
    "card"

    // The following props are only available on resource detail cards...
    // 'resource',
    // 'resourceId',
    // 'resourceName',
  ],

  mounted() {
    //
  }
};
</script>
