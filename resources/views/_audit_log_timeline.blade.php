{{--
    Partial: _audit_log_timeline.blade.php
    Usage:   @include('partials._audit_log_timeline', ['logs' => $auditLogs])
--}}
<style>
/* ── AUDIT LOG TIMELINE ─────────────────────────────────── */
.audit-timeline { position: relative; padding: 0.25rem 0; }

.audit-timeline::before {
    content: '';
    position: absolute; left: 18px; top: 0; bottom: 0;
    width: 2px;
    background: linear-gradient(to bottom, rgba(101,116,248,0.4), rgba(45,212,191,0.15));
    border-radius: 2px;
}

.audit-item {
    position: relative;
    display: flex; gap: 1rem;
    padding: 0 0 1.5rem 0;
    animation: fadeSlideIn 0.3s ease both;
}

.audit-item:last-child { padding-bottom: 0.5rem; }

@keyframes fadeSlideIn {
    from { opacity: 0; transform: translateY(8px); }
    to   { opacity: 1; transform: translateY(0); }
}

.audit-dot {
    position: relative; z-index: 1;
    width: 38px; height: 38px; border-radius: 0.7rem;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.85rem; flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
}

.audit-dot.color-emerald {
    background: rgba(52,211,153,0.15); border: 1px solid rgba(52,211,153,0.3);
    color: #34d399;
}
.audit-dot.color-amber {
    background: rgba(251,191,36,0.15); border: 1px solid rgba(251,191,36,0.3);
    color: #fbbf24;
}
.audit-dot.color-rose {
    background: rgba(251,113,133,0.15); border: 1px solid rgba(251,113,133,0.3);
    color: #fb7185;
}
.audit-dot.color-indigo {
    background: rgba(101,116,248,0.15); border: 1px solid rgba(101,116,248,0.3);
    color: #6574f8;
}

.audit-body {
    flex: 1;
    background: rgba(15,23,42,0.6);
    border: 1px solid rgba(99,130,255,0.1);
    border-radius: 1rem;
    padding: 0.9rem 1.1rem;
    transition: border-color 0.2s;
}
.audit-body:hover { border-color: rgba(99,130,255,0.22); }

.audit-header {
    display: flex; justify-content: space-between;
    align-items: flex-start; flex-wrap: wrap; gap: 0.4rem;
    margin-bottom: 0.5rem;
}

.audit-action-label {
    font-family: 'Sora', sans-serif;
    font-weight: 700; font-size: 0.85rem;
    color: #e8edf8;
}

.audit-time {
    font-size: 0.75rem; color: #607090;
    white-space: nowrap;
}

.audit-admin {
    font-size: 0.78rem; color: #a8b5d0;
    margin-bottom: 0.45rem;
}
.audit-admin i { color: #607090; }

.audit-status-row {
    display: flex; align-items: center; gap: 0.4rem;
    flex-wrap: wrap; margin-bottom: 0.45rem;
}

.status-pill {
    display: inline-flex; align-items: center; gap: 0.25rem;
    border-radius: 999px; padding: 0.18rem 0.65rem;
    font-size: 0.7rem; font-weight: 700;
}
.status-pill.s-menunggu { background: rgba(251,113,133,0.12); border: 1px solid rgba(251,113,133,0.25); color: #fb7185; }
.status-pill.s-proses   { background: rgba(251,191,36,0.12);  border: 1px solid rgba(251,191,36,0.25);  color: #fbbf24; }
.status-pill.s-selesai  { background: rgba(52,211,153,0.12);  border: 1px solid rgba(52,211,153,0.25);  color: #34d399; }
.status-pill.s-default  { background: rgba(99,130,255,0.1);   border: 1px solid rgba(99,130,255,0.2);   color: #a5b4fc; }

.audit-arrow { color: #607090; font-size: 0.75rem; }

.audit-feedback {
    background: rgba(101,116,248,0.07);
    border-left: 3px solid rgba(101,116,248,0.4);
    border-radius: 0 0.6rem 0.6rem 0;
    padding: 0.45rem 0.75rem;
    font-size: 0.82rem; color: #a8b5d0;
    font-style: italic;
    margin-top: 0.4rem;
}

.audit-notes {
    font-size: 0.78rem; color: #607090;
    margin-top: 0.35rem;
}

.audit-empty {
    text-align: center; padding: 2.5rem 1rem;
}
.audit-empty-icon {
    width: 56px; height: 56px; border-radius: 1rem;
    background: rgba(99,130,255,0.07); border: 1px solid rgba(99,130,255,0.12);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 1rem; font-size: 1.4rem; color: #607090;
}
.audit-empty h6 { font-family: 'Sora', sans-serif; font-weight: 700; color: #e8edf8; margin-bottom: 0.4rem; }
.audit-empty p  { color: #a8b5d0; font-size: 0.85rem; margin: 0; }
</style>

@if($logs->isEmpty())
    <div class="audit-empty">
        <div class="audit-empty-icon"><i class="bi bi-clock-history"></i></div>
        <h6>Belum Ada Riwayat</h6>
        <p>History aktivitas admin akan tampil di sini.</p>
    </div>
@else
    <div class="audit-timeline">
        @foreach($logs as $log)
            @php
                $dotColor = match($log->new_status) {
                    'Selesai'  => 'color-emerald',
                    'Proses'   => 'color-amber',
                    'Menunggu' => 'color-rose',
                    default    => 'color-indigo',
                };
                $pillClass = fn($s) => match($s) {
                    'Selesai'  => 's-selesai',
                    'Proses'   => 's-proses',
                    'Menunggu' => 's-menunggu',
                    default    => 's-default',
                };
            @endphp
            <div class="audit-item">
                {{-- Dot ikon --}}
                <div class="audit-dot {{ $dotColor }}">
                    <i class="bi {{ $log->action_icon }}"></i>
                </div>

                {{-- Konten log --}}
                <div class="audit-body">
                    <div class="audit-header">
                        <span class="audit-action-label">{{ $log->action_label }}</span>
                        <span class="audit-time">
                            <i class="bi bi-clock me-1"></i>
                            {{ $log->created_at->format('d M Y, H:i') }}
                        </span>
                    </div>

                    <div class="audit-admin">
                        <i class="bi bi-shield-check me-1"></i>
                        Oleh: <strong>{{ $log->admin_nama }}</strong>
                    </div>

                    {{-- Perubahan status --}}
                    @if($log->old_status && $log->new_status)
                        <div class="audit-status-row">
                            <span class="status-pill {{ $pillClass($log->old_status) }}">
                                {{ $log->old_status }}
                            </span>
                            <span class="audit-arrow"><i class="bi bi-arrow-right"></i></span>
                            <span class="status-pill {{ $pillClass($log->new_status) }}">
                                {{ $log->new_status }}
                            </span>
                        </div>
                    @endif

                    {{-- Feedback --}}
                    @if($log->feedback)
                        <div class="audit-feedback">
                            <i class="bi bi-chat-quote me-1" style="color: rgba(101,116,248,0.6);"></i>
                            "{{ $log->feedback }}"
                        </div>
                    @endif

                    {{-- Notes --}}
                    @if($log->notes)
                        <div class="audit-notes">
                            <i class="bi bi-info-circle me-1"></i>{{ $log->notes }}
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif