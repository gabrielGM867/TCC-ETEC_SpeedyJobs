ion.
     * @param blob blob to write into the parcel.
     */
    public native final void writeBuffer(HwBlob blob);
    /**
     * Write a status value into the blob.
     * @param status value to write
     */
    public native final void writeStatus(int status);
    /**
     * @throws IllegalArgumentException if a success vaue cannot be read
     * @throws RemoteException if success value indicates a transaction error
     */
    public native final void verifySuccess();
    /**
     * Should be called to reduce memory pressure when this object no longer needs
     * to be written to.
     */
    public native final void releaseTemporaryStorage();
    /**
     * Should be called when object is no longer needed to reduce possible memory
     * pressure if the Java GC does not get to this object in time.
     */
    public native final void release();

    /**
     * Sends the parcel to the specified destination.
     */
    public native final void send();

    // Returns address of the "freeFunction".
    private static native final long native_init();

    private native final void native_setup(boolean allocate);

    static {
        long freeFunction = native_init();

        sNativeRegistry = new NativeAllocationRegistry(
                HwParcel.class.getClassLoader(),
                freeFunction,
                128 /* size */);
    }

    private long mNativeContext;
}

                                                                                                                                                                                                                