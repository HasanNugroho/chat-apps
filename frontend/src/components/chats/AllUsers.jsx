import { useState, useEffect } from "react";

export default function AllUsers() {

    function classNames(...classes) {
        return classes.filter(Boolean).join(" ");
    }
    return (
        <>
        <ul className="overflow-auto h-[30rem]">
            <h2 className="my-2 mb-2 ml-2 text-gray-900 dark:text-white">Chats</h2>
            <li>
                {chatRooms.map((chatRoom, index) => (
                <div
                key={index}
                className={classNames(
                    index === selectedChat
                    ? "bg-gray-100 dark:bg-gray-700"
                    : "transition duration-150 ease-in-out cursor-pointer bg-white border-b border-gray-200 hover:bg-gray-100 dark:bg-gray-900 dark:border-gray-700 dark:hover:bg-gray-700",
                    "flex items-center px-3 py-2 text-sm "
                )}
                onClick={() => changeCurrentChat(index, chatRoom)}
                >
                <Contact
                    chatRoom={chatRoom}
                    onlineUsersId={onlineUsersId}
                    currentUser={currentUser}
                />
                </div>
            ))}
            </li>
        </ul>
        </>
    );
}