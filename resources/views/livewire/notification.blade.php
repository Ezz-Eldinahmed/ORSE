<div x-data="{ dropdownOpen: false }" class="relative">
    <button @click="dropdownOpen = !dropdownOpen" wire:click.prevent="show"
        class="relative z-10 bg-white rounded-md focus:outline-none">
        <svg class="w-5 h-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
        </svg>
        @if ($notifications->count() > 0)
        <p class="text-white text-xs p-0.5 -mt-4 ml-2 relative bg-red-500 rounded-lg">
            {{$notifications->count()}}
        </p>
        @endif
    </button>

    <div x-show="dropdownOpen" style="display: none" class="absolute right-0 z-20 mt-2 overflow-hidden bg-white rounded-md shadow-lg w-72">
        <div class="overflow-y-scroll max-h-72">
            @forelse ($notifications as $notification)

            @if($notification->type == 'App\\Notifications\\commentCourseForInstructor')
            @php
            $redirect = $notification->data['course']['id'];
            $action = $notification->data['course']['name'];
            @endphp
            <x-navbar-notification :notification=$notification message="Commented On Your Course" route='course.show'
                :redirect=$redirect :action=$action />
            @endif

            @if($notification->type == 'App\\Notifications\\commentVideoForInstructor')
            @php
            $redirect = $notification->data['video']['id'];
            $action = $notification->data['video']['name'];
            @endphp
            <x-navbar-notification :notification=$notification message="Commented On Video" route='video.show'
                :redirect=$redirect :action=$action />
            @endif

            @if($notification->type == 'App\\Notifications\\commentLessonForInstructor')
            @php
            $redirect = $notification->data['lesson']['id'];
            $action = $notification->data['lesson']['name'];
            @endphp
            <x-navbar-notification :notification=$notification message="Commented On Lesson" route='lesson.show'
                :redirect=$redirect :action=$action />
            @endif

            @if($notification->type == 'App\\Notifications\\CommentPost')
            @php
            $action = $notification->data['comment']['comment'];
            @endphp
            <x-navbar-notification :notification=$notification message="Commented On Your Post By" route='timeline'
                :action=$action />
            @endif

            @if($notification->type == 'App\\Notifications\\ReplyAdded')
            @php
            $action = $notification->data['question']['question'];
            $redirect = $notification->data['question']['id'];
            @endphp
            <x-navbar-notification :notification=$notification message="Replayed On Your Question" route='question.show'
                :action=$action :redirect=$redirect />
            @endif

            @if($notification->type == 'App\\Notifications\\FollowHappens')
            @php
            $action = $notification->data['user']['name'];
            $redirect = $notification->data['user']['id'];
            @endphp
            <x-navbar-notification :notification=$notification message="Start Following You" route='profile'
                :action=$action :redirect=$redirect />
            @endif

            @if($notification->type == 'App\\Notifications\\ReplySetToBestReply')
            @php
            $action = $notification->data['question']['question'];
            $redirect = $notification->data['question']['id'];
            @endphp
            <x-navbar-notification-without-user :notification=$notification message="Reply Be Best Reply"
                route='question.show' :action=$action :redirect=$redirect />
            @endif

            @if($notification->type == 'App\\Notifications\\InstructorApproved')
            @php
            $action = $notification->data['category']['name'];
            $redirect = $notification->data['category']['id'];
            @endphp
            <x-navbar-notification-without-user :notification=$notification message="Instructor Approved"
                route='category.show' :action=$action :redirect=$redirect />
            @endif

            @if($notification->type == 'App\\Notifications\\CourseApproved')
            @php
            $action = $notification->data['course']['name'];
            $redirect = $notification->data['course']['id'];
            @endphp
            <x-navbar-notification-without-user :notification=$notification message="Course Approved"
                route='course.show' :action=$action :redirect=$redirect />
            @endif

            @if($notification->type == 'App\\Notifications\\InterviewAdded')
            @php
            $action = $notification->data['category']['name'];
            $redirect = $notification->data['category']['id'];
            @endphp
            <x-navbar-notification-without-user :notification=$notification message="Your Now Added As An Interview"
                route='category.show' :action=$action :redirect=$redirect />
            @endif

            @if($notification->type == 'App\\Notifications\\LessonAdded')
            @php
            $action = $notification->data['course']['name'];
            $redirect = $notification->data['course']['id'];
            @endphp
            <x-navbar-notification-without-user :notification=$notification message="New Lesson Added On Course"
                route='course.show' :action=$action :redirect=$redirect />
            @endif

            @empty
            <p class="p-3 font-semibold text-white bg-yellow-300 text-md">
                No New Notifications
            </p>
            @endforelse
        </div>
        <a href="{{route('notification.show')}}" class="block py-2 font-bold text-center text-white bg-gray-800">See all
            Notifications
        </a>
    </div>
</div>
