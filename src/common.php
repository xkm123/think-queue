<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------
if (!function_exists('get_queue_commands')) {
    function get_queue_commands()
    {
        return [
            think\queue\command\Work::class,
            think\queue\command\Restart::class,
            think\queue\command\Listen::class,
            think\queue\command\Subscribe::class,
        ];
    }
}
if (method_exists('think\Console', 'starting')) {
    think\Console::starting(function (think\Console $console) {
        $console->addCommand(think\queue\command\Work::class);
        $console->addCommand(think\queue\command\Restart::class);
        $console->addCommand(think\queue\command\Listen::class);
        $console->addCommand(think\queue\command\Subscribe::class);
    });
} else if (method_exists('think\Console', 'addDefaultCommands')) {
    \think\Console::addDefaultCommands([
        think\queue\command\Work::class,
        think\queue\command\Restart::class,
        think\queue\command\Listen::class,
        think\queue\command\Subscribe::class,
    ]);
}
if (!function_exists('queue')) {

    /**
     * 添加到队列
     *
     * @param        $job
     * @param string $data
     * @param int    $delay
     * @param null   $queue
     */
    function queue($job, $data = '', $delay = 0, $queue = null)
    {
        if ($delay > 0) {
            \think\Queue::later($delay, $job, $data, $queue);
        } else {
            \think\Queue::push($job, $data, $queue);
        }
    }
}
