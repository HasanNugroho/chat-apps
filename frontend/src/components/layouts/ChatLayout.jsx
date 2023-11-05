import AllUsers from "../chats/AllUsers";

export default function ChatLayout() {
    return (
        <div className="container mx-auto">
            <div className="min-w-full bg-white border-x border-b border-gray-200 dark:bg-gray-900 dark:border-gray-700 rounded lg:grid lg:grid-cols-3">
            <div className="bg-white border-r border-gray-200 dark:bg-gray-900 dark:border-gray-700 lg:col-span-1">
                <AllUsers/>
                {/* <SearchUsers handleSearch={handleSearch} />
                <AllUsers
                // users={searchQuery !== "" ? filteredUsers : users}
                // chatRooms={searchQuery !== "" ? filteredRooms : chatRooms}
                // setChatRooms={setChatRooms}
                // onlineUsersId={onlineUsersId}
                // currentUser={currentUser}
                // changeChat={handleChatChange}
                /> */}
            </div>
    
            {/* {currentChat ? (
                <ChatRoom
                // currentChat={currentChat}
                // currentUser={currentUser}
                // socket={socket}
                />
            ) : (
                <Welcome />
            )} */}
            </div>
        </div>
    );
}