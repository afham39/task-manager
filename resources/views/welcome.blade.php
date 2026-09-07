<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Plan, organize, and complete your work with Taskflow.">
        <title>Taskflow | Simple task management</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#f6f7f4] text-zinc-900 antialiased">
        <div class="relative isolate overflow-hidden">
            <div class="absolute inset-x-0 top-0 -z-10 h-[520px] bg-[radial-gradient(circle_at_75%_10%,rgba(217,119,6,0.16),transparent_34%),linear-gradient(135deg,#f7f8f5_0%,#eef2ec_100%)]"></div>
            <div class="absolute -right-32 top-24 -z-10 h-72 w-72 rounded-full border border-amber-900/10 bg-amber-200/20 blur-3xl"></div>

            <header class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 lg:px-8">
                <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="Taskflow home">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-zinc-900 text-sm font-bold text-white shadow-lg shadow-zinc-900/15">TF</span>
                    <span class="text-lg font-semibold tracking-tight">Taskflow</span>
                </a>

                <nav class="flex items-center gap-3 text-sm font-medium">
                    @auth
                        <a href="{{ route('dashboard') }}" class="rounded-lg px-4 py-2 text-zinc-600 transition hover:bg-white hover:text-zinc-900">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-lg px-4 py-2 text-zinc-600 transition hover:bg-white hover:text-zinc-900">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-lg bg-zinc-900 px-4 py-2 text-white shadow-sm transition hover:bg-zinc-700">Create account</a>
                        @endif
                    @endauth
                </nav>
            </header>

            <main class="mx-auto max-w-7xl px-6 pb-20 pt-12 lg:px-8 lg:pt-20">
                <section class="grid items-center gap-14 lg:grid-cols-[1.05fr_0.95fr]">
                    <div class="max-w-2xl">
                        <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-amber-900/10 bg-white/75 px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.18em] text-amber-800 shadow-sm">
                            <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                            Work with clarity
                        </div>
                        <h1 class="max-w-xl text-5xl font-semibold leading-[1.02] tracking-[-0.04em] text-zinc-950 sm:text-6xl">Make progress visible.</h1>
                        <p class="mt-6 max-w-lg text-lg leading-8 text-zinc-600">Taskflow keeps your priorities, deadlines, and daily momentum in one calm workspace.</p>
                        <div class="mt-9 flex flex-wrap items-center gap-4">
                            @auth
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 rounded-xl bg-zinc-900 px-5 py-3 text-sm font-semibold text-white shadow-xl shadow-zinc-900/15 transition hover:-translate-y-0.5 hover:bg-zinc-700">Open dashboard <span aria-hidden="true">&#8594;</span></a>
                            @else
                                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-xl bg-zinc-900 px-5 py-3 text-sm font-semibold text-white shadow-xl shadow-zinc-900/15 transition hover:-translate-y-0.5 hover:bg-zinc-700">Start organizing <span aria-hidden="true">&#8594;</span></a>
                            @endauth
                            <span class="text-sm text-zinc-500">Built for focused work</span>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute -inset-5 rounded-[2rem] bg-amber-300/20 blur-2xl"></div>
                        <div class="relative overflow-hidden rounded-2xl border border-zinc-200/80 bg-white p-5 shadow-2xl shadow-zinc-900/10">
                            <div class="flex items-center justify-between border-b border-zinc-100 pb-4">
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-[0.16em] text-zinc-400">This week</p>
                                    <h2 class="mt-1 text-xl font-semibold tracking-tight">My tasks</h2>
                                </div>
                                <span class="rounded-lg bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-800">4 of 7 done</span>
                            </div>
                            <div class="mt-5 space-y-3">
                                <div class="flex items-center gap-3 rounded-xl bg-zinc-50 p-3">
                                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-100 text-sm text-emerald-700">&#10003;</span>
                                    <span class="flex-1 text-sm text-zinc-500 line-through">Review project requirements</span>
                                    <span class="text-[11px] font-medium text-zinc-400">DONE</span>
                                </div>
                                <div class="flex items-center gap-3 rounded-xl border border-amber-200 bg-amber-50/60 p-3">
                                    <span class="h-6 w-6 rounded-full border-2 border-amber-500"></span>
                                    <span class="flex-1 text-sm font-medium text-zinc-800">Prepare final submission</span>
                                    <span class="text-[11px] font-medium text-amber-700">TODAY</span>
                                </div>
                                <div class="flex items-center gap-3 rounded-xl bg-zinc-50 p-3">
                                    <span class="h-6 w-6 rounded-full border-2 border-zinc-300"></span>
                                    <span class="flex-1 text-sm font-medium text-zinc-700">Plan next sprint</span>
                                    <span class="text-[11px] font-medium text-zinc-400">FRI</span>
                                </div>
                            </div>
                            <div class="mt-5 flex items-center justify-between border-t border-zinc-100 pt-4 text-sm">
                                <span class="text-zinc-500">Your workspace is moving forward.</span>
                                <span class="font-semibold text-amber-700">&#8599;</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mt-24 border-t border-zinc-200/80 pt-8">
                    <div class="grid gap-8 md:grid-cols-3">
                        <div>
                            <p class="text-sm font-semibold text-zinc-900">01 <span class="ml-2 text-zinc-300">/</span></p>
                            <h2 class="mt-4 text-lg font-semibold">Capture the work</h2>
                            <p class="mt-2 text-sm leading-6 text-zinc-500">Create tasks with priorities, status, descriptions, and due dates that keep the details close.</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-zinc-900">02 <span class="ml-2 text-zinc-300">/</span></p>
                            <h2 class="mt-4 text-lg font-semibold">Find your focus</h2>
                            <p class="mt-2 text-sm leading-6 text-zinc-500">Search by keyword and filter your list by status or priority when the work starts to pile up.</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-zinc-900">03 <span class="ml-2 text-zinc-300">/</span></p>
                            <h2 class="mt-4 text-lg font-semibold">Own your progress</h2>
                            <p class="mt-2 text-sm leading-6 text-zinc-500">Your tasks stay private to your account, with a dashboard that makes progress easy to scan.</p>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
