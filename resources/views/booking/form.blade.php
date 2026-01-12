<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div class="">
        <label for="room_id" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'Room Id' }}</label>
        <input class="w-full h-10 px-3 rounded-lg border {{ $errors->has('room_id') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
               name="room_id" type="text" id="room_id" value="{{ isset($booking->room_id) ? $booking->room_id : ''}}" >
        {!! $errors->first('room_id', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
    </div>

    <div class="">
        <label for="user_id" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'User Id' }}</label>
        <input class="w-full h-10 px-3 rounded-lg border {{ $errors->has('user_id') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
               name="user_id" type="text" id="user_id" value="{{ isset($booking->user_id) ? $booking->user_id : ''}}" >
        {!! $errors->first('user_id', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
    </div>

    <div class="">
        <label for="subject" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'Subject' }}</label>
        <input class="w-full h-10 px-3 rounded-lg border {{ $errors->has('subject') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
               name="subject" type="text" id="subject" value="{{ isset($booking->subject) ? $booking->subject : ''}}" >
        {!! $errors->first('subject', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
    </div>

    <div class="">
        <label for="name_professor" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'Name Professor' }}</label>
        <input class="w-full h-10 px-3 rounded-lg border {{ $errors->has('name_professor') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
               name="name_professor" type="text" id="name_professor" value="{{ isset($booking->name_professor) ? $booking->name_professor : ''}}" >
        {!! $errors->first('name_professor', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
    </div>

    <div class="col-span-1 md:col-span-2">
        <label for="note" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'Note' }}</label>
        <input class="w-full h-10 px-3 rounded-lg border {{ $errors->has('note') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
               name="note" type="text" id="note" value="{{ isset($booking->note) ? $booking->note : ''}}" >
        {!! $errors->first('note', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
    </div>

    <div class="">
        <label for="semester" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'Semester' }}</label>
        <input class="w-full h-10 px-3 rounded-lg border {{ $errors->has('semester') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
               name="semester" type="text" id="semester" value="{{ isset($booking->semester) ? $booking->semester : ''}}" >
        {!! $errors->first('semester', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
    </div>

    <div class="">
        <label for="date_booking" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'Date Booking' }}</label>
        <input class="cursor-pointer w-full h-10 px-3 rounded-lg border {{ $errors->has('date_booking') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
               name="date_booking" type="date" id="date_booking" 
               onclick="this.showPicker()"
               value="{{ isset($booking->date_booking) ? $booking->date_booking : ''}}" >
        {!! $errors->first('date_booking', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
    </div>

    <div class="">
        <label for="time_start_booking" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'Time Start Booking' }}</label>
        <input class="cursor-pointer w-full h-10 px-3 rounded-lg border {{ $errors->has('time_start_booking') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
               name="time_start_booking" type="time" id="time_start_booking" 
               onclick="this.showPicker()"
               value="{{ isset($booking->time_start_booking) ? $booking->time_start_booking : ''}}" >
        {!! $errors->first('time_start_booking', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
    </div>

    <div class="">
        <label for="time_end_booking" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'Time End Booking' }}</label>
        <input class="cursor-pointer w-full h-10 px-3 rounded-lg border {{ $errors->has('time_end_booking') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
               name="time_end_booking" type="time" id="time_end_booking" 
               onclick="this.showPicker()"
               value="{{ isset($booking->time_end_booking) ? $booking->time_end_booking : ''}}" >
        {!! $errors->first('time_end_booking', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
    </div>

    <div class="">
        <label for="time_get_key" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'Time Get Key' }}</label>
        <input class="cursor-pointer w-full h-10 px-3 rounded-lg border {{ $errors->has('time_get_key') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
               name="time_get_key" type="time" id="time_get_key" 
               onclick="this.showPicker()"
               value="{{ isset($booking->time_get_key) ? $booking->time_get_key : ''}}" >
        {!! $errors->first('time_get_key', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
    </div>

    <div class="">
        <label for="time_return_key" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'Time Return Key' }}</label>
        <input class="cursor-pointer w-full h-10 px-3 rounded-lg border {{ $errors->has('time_return_key') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
               name="time_return_key" type="time" id="time_return_key" 
               onclick="this.showPicker()"
               value="{{ isset($booking->time_return_key) ? $booking->time_return_key : ''}}" >
        {!! $errors->first('time_return_key', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
    </div>

    <div class="">
        <label for="code_for_qr" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'Code For Qr' }}</label>
        <input class="w-full h-10 px-3 rounded-lg border {{ $errors->has('code_for_qr') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
               name="code_for_qr" type="text" id="code_for_qr" value="{{ isset($booking->code_for_qr) ? $booking->code_for_qr : ''}}" >
        {!! $errors->first('code_for_qr', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
    </div>

    <div class="">
        <label for="id_officer_give_key" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'Id Officer Give Key' }}</label>
        <input class="w-full h-10 px-3 rounded-lg border {{ $errors->has('id_officer_give_key') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
               name="id_officer_give_key" type="text" id="id_officer_give_key" value="{{ isset($booking->id_officer_give_key) ? $booking->id_officer_give_key : ''}}" >
        {!! $errors->first('id_officer_give_key', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
    </div>

    <div class="">
        <label for="id_officer_return_key" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'Id Officer Return Key' }}</label>
        <input class="w-full h-10 px-3 rounded-lg border {{ $errors->has('id_officer_return_key') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
               name="id_officer_return_key" type="text" id="id_officer_return_key" value="{{ isset($booking->id_officer_return_key) ? $booking->id_officer_return_key : ''}}" >
        {!! $errors->first('id_officer_return_key', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
    </div>

    <div class="">
        <label for="status" class="block font-medium text-sm text-[#111418] dark:text-gray-200 mb-2">{{ 'Status' }}</label>
        <input class="w-full h-10 px-3 rounded-lg border {{ $errors->has('status') ? 'border-red-500 focus:ring-red-500' : 'border-[#dce0e5] dark:border-gray-700 focus:ring-primary' }} bg-white dark:bg-gray-800 text-[#111418] dark:text-white focus:outline-none focus:ring-2 focus:border-transparent transition-all" 
               name="status" type="text" id="status" value="{{ isset($booking->status) ? $booking->status : ''}}" >
        {!! $errors->first('status', '<p class="text-red-500 text-xs mt-1">:message</p>') !!}
    </div>

</div>

<div class="mt-8 pt-4 border-t border-[#dce0e5] dark:border-gray-700 flex justify-end">
    <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-primary hover:bg-primary-hover text-white font-bold rounded-lg shadow-sm transition-colors cursor-pointer flex items-center justify-center gap-2">
        <span class="material-symbols-outlined text-[20px]">save</span>
        <span>{{ $formMode === 'edit' ? 'บันทึกการแก้ไข' : 'ยืนยันการสร้าง' }}</span>
    </button>
</div>