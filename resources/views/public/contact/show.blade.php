<x-layouts.public title="Kontak">
    <x-public-page-header title="Kontak Desa"
        eyebrow="Hubungi Kami"
        description="Kami siap melayani pertanyaan, aspirasi, dan kebutuhan informasi Anda."
        :crumbs="[['label' => 'Kontak']]" />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        <div class="max-w-3xl mx-auto space-y-4">

            {{-- Info Kontak --}}
            <div class="space-y-4">
                <div class="flex gap-4 bg-white border border-slate-200 rounded-2xl p-5 hover:shadow-md transition">
                    <div class="w-11 h-11 rounded-xl bg-[#192E03]/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide">Alamat Kantor</p>
                        <p class="text-slate-800 mt-1 text-sm">{{ $contact->address }}</p>
                    </div>
                </div>

                @if ($contact->phone)
                    <div class="flex gap-4 bg-white border border-slate-200 rounded-2xl p-5 hover:shadow-md transition">
                        <div class="w-11 h-11 rounded-xl bg-[#192E03]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 7V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide">Telepon</p>
                            <a href="tel:{{ $contact->phone }}" class="text-slate-800 mt-1 text-sm block hover:text-[#192E03] transition">{{ $contact->phone }}</a>
                        </div>
                    </div>
                @endif

                @if ($contact->whatsapp)
                    <div class="flex gap-4 bg-white border border-slate-200 rounded-2xl p-5 hover:shadow-md transition">
                        <div class="w-11 h-11 rounded-xl bg-[#192E03]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide">WhatsApp</p>
                            <a href="https://wa.me/{{ \App\Support\PhoneNumber::waNumber($contact->whatsapp) }}"
                                target="_blank"
                                class="text-slate-800 mt-1 text-sm block hover:text-[#192E03] transition">
                                {{ $contact->whatsapp }}
                            </a>
                        </div>
                    </div>
                @endif

                @if ($contact->email)
                    <div class="flex gap-4 bg-white border border-slate-200 rounded-2xl p-5 hover:shadow-md transition">
                        <div class="w-11 h-11 rounded-xl bg-[#192E03]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide">Email</p>
                            <a href="mailto:{{ $contact->email }}" class="text-slate-800 mt-1 text-sm block hover:text-[#192E03] transition">{{ $contact->email }}</a>
                        </div>
                    </div>
                @endif

                @if ($contact->office_hours)
                    <div class="flex gap-4 bg-white border border-slate-200 rounded-2xl p-5 hover:shadow-md transition">
                        <div class="w-11 h-11 rounded-xl bg-[#192E03]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide">Jam Layanan</p>
                            <p class="text-slate-800 mt-1 text-sm">{{ $contact->office_hours }}</p>
                        </div>
                    </div>
                @endif

                {{-- Media Sosial --}}
                @if ($contact->facebook || $contact->instagram || $contact->youtube || $contact->tiktok)
                    <div class="pt-2">
                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-3">Ikuti Kami</p>
                        <div class="flex flex-wrap gap-3">
                            @if ($contact->facebook)
                                <a href="{{ $contact->facebook }}" target="_blank"
                                    class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold bg-white border border-slate-200 text-slate-700 rounded-full hover:border-[#192E03]/50 hover:text-[#192E03] hover:shadow-sm transition">
                                    <svg class="w-4 h-4 text-[#192E03]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/>
                                    </svg>
                                    Facebook
                                </a>
                            @endif
                            @if ($contact->instagram)
                                <a href="{{ $contact->instagram }}" target="_blank"
                                    class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold bg-white border border-slate-200 text-slate-700 rounded-full hover:border-[#192E03]/50 hover:text-[#192E03] hover:shadow-sm transition">
                                    <svg class="w-4 h-4 text-[#192E03]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm10 10a5 5 0 11-10 0 5 5 0 0110 0zm-9 0a4 4 0 108 0 4 4 0 00-8 0zm6.5-6.5a1.25 1.25 0 100-2.5 1.25 1.25 0 000 2.5z"/>
                                    </svg>
                                    Instagram
                                </a>
                            @endif
                            @if ($contact->youtube)
                                <a href="{{ $contact->youtube }}" target="_blank"
                                    class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold bg-white border border-slate-200 text-slate-700 rounded-full hover:border-[#192E03]/50 hover:text-[#192E03] hover:shadow-sm transition">
                                    <svg class="w-4 h-4 text-[#192E03]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.5 6.19a3.02 3.02 0 00-2.12-2.14C19.5 3.55 12 3.55 12 3.55s-7.5 0-9.38.5A3.02 3.02 0 00.5 6.19C0 8.07 0 12 0 12s0 3.93.5 5.81a3.02 3.02 0 002.12 2.14c1.88.5 9.38.5 9.38.5s7.5 0 9.38-.5a3.02 3.02 0 002.12-2.14C24 15.93 24 12 24 12s0-3.93-.5-5.81zM9.55 15.57V8.43L15.82 12l-6.27 3.57z"/>
                                    </svg>
                                    YouTube
                                </a>
                            @endif
                            @if ($contact->tiktok)
                                <a href="{{ $contact->tiktok }}" target="_blank"
                                    class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold bg-white border border-slate-200 text-slate-700 rounded-full hover:border-[#192E03]/50 hover:text-[#192E03] hover:shadow-sm transition">
                                    <svg class="w-4 h-4 text-[#192E03]" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                    </svg>
                                    TikTok
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            {{-- Peta --}}
            @if ($contact->map_embed)
                <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm h-80 mt-4">
                    {!! $contact->map_embed !!}
                </div>
            @endif
        </div>
    </div>
</x-layouts.public>
