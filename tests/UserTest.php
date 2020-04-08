<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {
    public function testReturnsFullName() {
        $mock = $this->createMock(Mailer::class);

        $user = new User($mock);

        $user->first_name = "Teresa";
        $user->surname = "Green";

        $this->assertEquals('Teresa Green', $user->getFullName());
    }

    public function testFullNameIsEmptyByDefault() {
        $mock = $this->createMock(Mailer::class);

        $user = new User($mock);

        $this->assertEquals('', $user->getFullName());
    }

    public function testNotificationSent() {
        $mock = $this->createMock(Mailer::class);
        $mock->expects($this->once())
            ->method('sendMessage')
            ->with($this->equalTo('mail@mail.og'), 'word up')
            ->willReturn(true);
        $user = new User($mock);
        $user->email = 'mail@mail.og';
        $this->assertTrue($user->notify('word up'));

    }

    public function testNoEmailNoMessage() {

        $mockMailer = $this->getMockBuilder(Mailer::class)
            ->setMethods(['sendMessage'])->getMock();

        $user = new User($mockMailer);
        $this->expectException(Exception::class);
        $user->notify('hello');
    }
}
