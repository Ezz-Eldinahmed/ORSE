@extends('layouts.app')

@section('content')

<x-header-component message="All Your Notifications" header="Notification" />
<div class="overflow-x-hidden bg-gray-100">
    <div class="grid grid-cols-3 gap-2 m-2">
        <div class="col-span-2">
            <div class="flex flex-wrap -m-4">
                @forelse ($notifications as $notification)
                <div class="p-2">
                    @if($notification->type == 'App\Notifications\LikePost')
                    <x-notification :notification=$notification message="Like Your Post" route='timeline' />
                    @endif

                    @if($notification->type == 'App\\Notifications\\commentCourseForInstructor')
                    @php
                    $redirect = $notification->data['course']['id'];
                    $action = $notification->data['course']['name'];
                    @endphp
                    <x-notification :notification=$notification message="Commented On Course" route='course.show'
                        :redirect=$redirect :action=$action />
                    @endif

                    @if($notification->type == 'App\\Notifications\\commentVideoForInstructor')
                    @php
                    $redirect = $notification->data['video']['id'];
                    $action = $notification->data['video']['name'];
                    @endphp
                    <x-notification :notification=$notification message="Commented On Video" route='video.show'
                        :redirect=$redirect :action=$action />
                    @endif

                    @if($notification->type == 'App\\Notifications\\commentLessonForInstructor')
                    @php
                    $redirect = $notification->data['lesson']['id'];
                    $action = $notification->data['lesson']['name'];
                    @endphp
                    <x-notification :notification=$notification message="Commented On Lesson" route='lesson.show'
                        :redirect=$redirect :action=$action />
                    @endif

                    @if($notification->type == 'App\\Notifications\\CommentPost')
                    @php
                    $action = $notification->data['comment']['comment'];
                    @endphp
                    <x-notification :notification=$notification message="Commented On Your Post By" route='timeline'
                        :action=$action />
                    @endif

                    @if($notification->type == 'App\\Notifications\\ReplyAdded')
                    @php
                    $action = $notification->data['question']['question'];
                    $redirect = $notification->data['question']['id'];
                    @endphp
                    <x-notification :notification=$notification message="Replayed On Your Question"
                        route='question.show' :action=$action :redirect=$redirect />
                    @endif

                    @if($notification->type == 'App\\Notifications\\FollowHappens')
                    @php
                    $action = $notification->data['user']['name'];
                    $redirect = $notification->data['user']['id'];
                    @endphp
                    <x-notification :notification=$notification message="Start Following You" route='profile'
                        :action=$action :redirect=$redirect />
                    @endif

                    @if($notification->type == 'App\\Notifications\\ReplySetToBestReply')
                    @php
                    $action = $notification->data['question']['question'];
                    $redirect = $notification->data['question']['id'];
                    @endphp
                    <x-notification-without-user :notification=$notification message="Reply Be Best Reply"
                        route='question.show' :action=$action :redirect=$redirect />
                    @endif

                    @if($notification->type == 'App\\Notifications\\InstructorApproved')
                    @php
                    $action = $notification->data['category']['name'];
                    $redirect = $notification->data['category']['id'];
                    @endphp
                    <x-notification-without-user :notification=$notification message="Instructor Approved"
                        route='category.show' :action=$action :redirect=$redirect />
                    @endif

                    @if($notification->type == 'App\\Notifications\\CourseApproved')
                    @php
                    $action = $notification->data['course']['name'];
                    $redirect = $notification->data['course']['id'];
                    @endphp
                    <x-notification-without-user :notification=$notification message="Course Approved"
                        route='course.show' :action=$action :redirect=$redirect />
                    @endif

                    @if($notification->type == 'App\\Notifications\\InterviewAdded')
                    @php
                    $action = $notification->data['category']['name'];
                    $redirect = $notification->data['category']['id'];
                    @endphp
                    <x-notification-without-user :notification=$notification message="Your Now Added As An Interview"
                        route='category.show' :action=$action :redirect=$redirect />
                    @endif

                    @if($notification->type == 'App\\Notifications\\LessonAdded')
                    @php
                    $action = $notification->data['course']['name'];
                    $redirect = $notification->data['course']['id'];
                    @endphp
                    <x-notification-without-user :notification=$notification message="New Lesson Added On Course"
                        route='course.show' :action=$action :redirect=$redirect />
                    @endif

                </div>
                @empty
                <p class="p-5 m-5 font-bold text-white bg-purple-400 rounded shadow-lg">No Notification Founded</p>
                @endforelse
            </div>
            <x-paginator :paginator=$notifications />
        </div>
        <div>
            <x-side-bar />
        </div>
    </div>
</div>
@endsection
